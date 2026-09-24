/* Acadlytic — floating "Talk to Acadlytic" contact widget
   (components/contact-widget.php). Progressive enhancement: without this
   script the button and any [data-acw-open] trigger are plain links to the
   contact page. No third-party code, no inline scripts (CSP-safe).

   Analytics hooks (privacy-conscious, no personal data):
     window 'acadlytic:analytics' CustomEvent { detail: { event } }
     and window.dataLayer.push({ event }) only if a dataLayer already exists.
   Events: enquiry_widget_open, enquiry_form_open, enquiry_form_submit,
           email_click, whatsapp_click, call_click */
(function () {
  'use strict';

  var root = document.querySelector('[data-acw]');
  if (!root) return;

  var fab = root.querySelector('[data-acw-toggle]');
  var panel = root.querySelector('[data-acw-panel]');
  // Other controls that open the same panel (e.g. the footer CTA).
  var openers = Array.prototype.slice.call(document.querySelectorAll('[data-acw-open]'));
  var triggers = [fab].concat(openers);
  // The modal lives in a <template> (out of the live DOM) until first use.
  var tpl = root.querySelector('[data-acw-modal-tpl]');
  var modal = null, form = null, alertBox = null, formWrap = null, success = null;
  var reduce = window.matchMedia('(prefers-reduced-motion: reduce)');
  var lastTrigger = fab;
  var tokenPromise = null;

  function track(name) {
    var detail = { event: name };
    try { window.dispatchEvent(new CustomEvent('acadlytic:analytics', { detail: detail })); } catch (e) { /* old browsers */ }
    if (Array.isArray(window.dataLayer)) window.dataLayer.push(detail);
  }

  /* ---------- Panel ---------- */
  function isOpen() { return !panel.hidden; }

  function setExpanded(open) {
    triggers.forEach(function (t) { t.setAttribute('aria-expanded', String(open)); });
  }

  function openPanel(trigger) {
    lastTrigger = trigger || fab;
    if (isOpen()) { var f = panel.querySelector('.acw-action'); if (f) f.focus(); return; }
    panel.hidden = false;
    // next frame so the transition runs
    requestAnimationFrame(function () { panel.classList.add('is-open'); });
    setExpanded(true);
    var first = panel.querySelector('.acw-action');
    if (first) first.focus({ preventScroll: true });
    track('enquiry_widget_open');
  }

  function closePanel(returnFocus) {
    if (!isOpen()) return;
    panel.classList.remove('is-open');
    setExpanded(false);
    var done = function () { panel.hidden = true; };
    if (reduce.matches) done(); else setTimeout(done, 200);
    if (returnFocus) lastTrigger.focus({ preventScroll: true });
  }

  // Links that act as buttons once JS is running: role, Space key, toggle.
  triggers.forEach(function (t) {
    t.setAttribute('role', 'button');
    t.setAttribute('aria-controls', 'acw-panel');
    t.setAttribute('aria-haspopup', 'dialog');
    t.setAttribute('aria-expanded', 'false');
    t.addEventListener('click', function (event) {
      event.preventDefault();
      if (isOpen() && t === lastTrigger) closePanel(false); else openPanel(t);
    });
    t.addEventListener('keydown', function (event) {
      if (event.key === ' ' || event.key === 'Spacebar') { event.preventDefault(); t.click(); }
    });
  });

  // Compact button while the footer (which has its own CTA) is in view.
  var footer = document.querySelector('.site-footer');
  if (footer && 'IntersectionObserver' in window) {
    new IntersectionObserver(function (entries) {
      root.classList.toggle('is-compact', entries[0].isIntersecting);
    }).observe(footer);
  }

  root.querySelectorAll('[data-acw-close]').forEach(function (btn) {
    btn.addEventListener('click', function () { closePanel(true); });
  });

  document.addEventListener('keydown', function (event) {
    if (event.key === 'Escape' && isOpen() && !(modal && modal.open)) {
      closePanel(true);
    }
  });

  document.addEventListener('click', function (event) {
    if (isOpen() && !panel.contains(event.target) && !triggers.some(function (t) { return t.contains(event.target); })) {
      closePanel(false);
    }
  });

  root.querySelectorAll('[data-acw-event]').forEach(function (link) {
    link.addEventListener('click', function () {
      track(link.getAttribute('data-acw-event'));
      if (link.getAttribute('data-acw-event') !== 'call_click') closePanel(false);
    });
  });

  /* ---------- Modal + form ---------- */
  var formBtn = root.querySelector('[data-acw-open-form]');
  if (!tpl || typeof HTMLDialogElement !== 'function') {
    // No <dialog> support: fall back to the contact page for the form.
    formBtn.addEventListener('click', function () { window.location.href = '/core/contact/'; });
    return;
  }

  function mount() {
    if (modal) return;
    root.appendChild(tpl.content.cloneNode(true));
    modal = root.querySelector('[data-acw-modal]');
    form = modal.querySelector('form');
    alertBox = modal.querySelector('[data-acw-alert]');
    formWrap = modal.querySelector('[data-acw-form-wrap]');
    success = modal.querySelector('[data-acw-success]');
    modal.querySelectorAll('[data-acw-modal-close]').forEach(function (btn) {
      btn.addEventListener('click', closeModal);
    });
    // Click on the backdrop (outside the inner card) closes the modal.
    modal.addEventListener('click', function (event) {
      if (event.target === modal) closeModal();
    });
    modal.addEventListener('close', function () { lastTrigger.focus({ preventScroll: true }); });
    // Client-side checks must run before our submit handler (it respects
    // event.defaultPrevented), so enhance first.
    if (window.AcadlyticForms) window.AcadlyticForms.enhance(form);
    form.addEventListener('submit', onSubmit);
  }

  function fetchToken(force) {
    if (!tokenPromise || force) {
      tokenPromise = fetch('/enquiry/token/', { credentials: 'same-origin', headers: { Accept: 'application/json' } })
        .then(function (r) { if (!r.ok) throw new Error('token'); return r.json(); })
        .then(function (d) {
          form.querySelector('[name="_token"]').value = d.token;
          form.querySelector('[name="_ts"]').value = d.ts;
          return d;
        })
        .catch(function (e) { tokenPromise = null; throw e; });
    }
    return tokenPromise;
  }

  function openModal() {
    mount();
    closePanel(false);
    resetMessages();
    formWrap.hidden = false;
    success.hidden = true;
    modal.showModal();
    fetchToken(false).catch(function () {});
    var first = form.querySelector('input:not([type="hidden"]):not([tabindex="-1"])');
    if (first) first.focus();
    track('enquiry_form_open');
  }

  function closeModal() {
    if (modal.open) modal.close();
  }

  formBtn.addEventListener('click', openModal);

  function fieldById(name) { return form.querySelector('[name="' + name + '"]'); }

  // Same inline-error markup as every other site form (app.js).
  function setFieldError(field, msg) {
    if (window.AcadlyticForms) window.AcadlyticForms.fieldError(field, msg);
  }

  function resetMessages() {
    alertBox.hidden = true;
    alertBox.textContent = '';
    form.querySelectorAll('[aria-invalid="true"]').forEach(function (f) { setFieldError(f, ''); });
  }

  function showAlert(message) {
    alertBox.textContent = message;
    alertBox.hidden = false;
    alertBox.focus();
  }

  function setLoading(on) {
    var btn = form.querySelector('button[type="submit"]');
    btn.classList.toggle('is-loading', on);
    btn.disabled = on;
    if (on) btn.setAttribute('aria-busy', 'true'); else btn.removeAttribute('aria-busy');
    btn.removeAttribute('aria-disabled');
  }

  var failMessage = 'We couldn’t submit your enquiry right now. Please try again or contact us by email or WhatsApp.';

  function submit(retried) {
    var data = new FormData(form);
    data.append('_page', window.location.pathname);
    return fetch('/enquiry/', {
      method: 'POST', body: data, credentials: 'same-origin', headers: { Accept: 'application/json' }
    }).then(function (r) {
      return r.json().catch(function () { return {}; }).then(function (d) { return { status: r.status, data: d }; });
    }).then(function (res) {
      if (res.status === 419 && !retried) {
        return fetchToken(true).then(function () { return submit(true); });
      }
      if (res.data && res.data.ok) {
        form.reset();
        tokenPromise = null;
        formWrap.hidden = true;
        success.hidden = false;
        success.focus();
        return;
      }
      var errors = (res.data && res.data.errors) || {};
      var firstBad = null;
      Object.keys(errors).forEach(function (name) {
        var f = fieldById(name);
        if (f) { setFieldError(f, errors[name]); if (!firstBad) firstBad = f; }
      });
      showAlert((res.data && res.data.message) || failMessage);
      if (firstBad) firstBad.focus();
    });
  }

  function onSubmit(event) {
    // app.js's enhance() handler runs first and cancels invalid submissions.
    if (event.defaultPrevented) return;
    event.preventDefault();
    resetMessages();
    setLoading(true);
    track('enquiry_form_submit');
    fetchToken(false)
      .then(function () { return submit(false); })
      .catch(function () { showAlert(failMessage); })
      .then(function () { setLoading(false); });
  }
})();
