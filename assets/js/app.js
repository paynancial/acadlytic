/* Acadlytic — progressive enhancement. The site is fully usable without
   this file: menus fall back to CSS :hover/:focus-within, the mobile menu
   button links to the HTML sitemap and forms validate on the server. */
(function () {
  'use strict';

  var root = document.documentElement;
  root.classList.remove('no-js');
  root.classList.add('js');

  var desktop = window.matchMedia('(min-width: 1081px)');

  function ready(fn) {
    if (document.readyState !== 'loading') fn();
    else document.addEventListener('DOMContentLoaded', fn);
  }

  ready(function () {
    initHeaderShadow();
    initMegaMenu();
    initPopovers();
    initDrawer();
    initForms();
    initPasswordToggles();
  });

  /* ---------- Header shadow on scroll ---------- */
  function initHeaderShadow() {
    var header = document.querySelector('[data-header]');
    if (!header) return;
    var onScroll = function () { header.classList.toggle('is-scrolled', window.scrollY > 8); };
    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();
  }

  /* ---------- Mega menu ---------- */
  function initMegaMenu() {
    var header = document.querySelector('[data-header]');
    var items = Array.prototype.slice.call(document.querySelectorAll('[data-mega]'));
    if (!header || !items.length) return;
    var triggers = items.map(function (item) { return item.querySelector('[data-mega-trigger]'); });
    var openTimer = null;
    var closeTimer = null;

    function links(item) {
      return Array.prototype.slice.call(item.querySelectorAll('[data-mega-panel] a'));
    }
    function open(item) {
      items.forEach(function (other) { if (other !== item) close(other); });
      item.classList.add('is-open');
      item.querySelector('[data-mega-trigger]').setAttribute('aria-expanded', 'true');
      header.classList.add('mega-open');
      document.body.classList.add('mega-open');
    }
    function close(item) {
      item.classList.remove('is-open');
      item.querySelector('[data-mega-trigger]').setAttribute('aria-expanded', 'false');
      if (!items.some(function (i) { return i.classList.contains('is-open'); })) {
        header.classList.remove('mega-open');
        document.body.classList.remove('mega-open');
      }
    }
    function closeAll() { items.forEach(close); }

    items.forEach(function (item, index) {
      var trigger = triggers[index];

      trigger.addEventListener('click', function () {
        if (item.classList.contains('is-open')) close(item); else open(item);
      });

      item.addEventListener('mouseenter', function () {
        if (!desktop.matches) return;
        clearTimeout(closeTimer);
        clearTimeout(openTimer);
        var anyOpen = items.some(function (i) { return i.classList.contains('is-open'); });
        openTimer = setTimeout(function () { open(item); }, anyOpen ? 0 : 90);
      });
      item.addEventListener('mouseleave', function () {
        if (!desktop.matches) return;
        clearTimeout(openTimer);
        closeTimer = setTimeout(function () { close(item); }, 160);
      });

      item.addEventListener('focusout', function (event) {
        if (!item.contains(event.relatedTarget)) close(item);
      });

      trigger.addEventListener('keydown', function (event) {
        var key = event.key;
        if (key === 'ArrowDown') {
          event.preventDefault();
          open(item);
          var first = links(item)[0];
          if (first) first.focus();
        } else if (key === 'ArrowRight' || key === 'ArrowLeft') {
          event.preventDefault();
          var next = triggers[(index + (key === 'ArrowRight' ? 1 : triggers.length - 1)) % triggers.length];
          var wasOpen = item.classList.contains('is-open');
          next.focus();
          if (wasOpen) open(items[triggers.indexOf(next)]);
        } else if (key === 'Home' || key === 'End') {
          event.preventDefault();
          triggers[key === 'Home' ? 0 : triggers.length - 1].focus();
        }
      });

      item.querySelector('[data-mega-panel]').addEventListener('keydown', function (event) {
        var list = links(item);
        var pos = list.indexOf(document.activeElement);
        if (event.key === 'ArrowDown' || event.key === 'ArrowUp') {
          event.preventDefault();
          var step = event.key === 'ArrowDown' ? 1 : -1;
          list[(pos + step + list.length) % list.length].focus();
        } else if (event.key === 'Home' || event.key === 'End') {
          event.preventDefault();
          list[event.key === 'Home' ? 0 : list.length - 1].focus();
        }
      });
    });

    document.addEventListener('keydown', function (event) {
      if (event.key !== 'Escape') return;
      var openItem = items.filter(function (i) { return i.classList.contains('is-open'); })[0];
      if (openItem) {
        close(openItem);
        openItem.querySelector('[data-mega-trigger]').focus();
      }
    });
    document.addEventListener('click', function (event) {
      if (!event.target.closest('[data-mega]')) closeAll();
    });
    var backdrop = document.querySelector('[data-mega-backdrop]');
    if (backdrop) backdrop.addEventListener('click', closeAll);
    desktop.addEventListener && desktop.addEventListener('change', closeAll);
  }

  /* ---------- Popovers (login selector) ---------- */
  function initPopovers() {
    Array.prototype.forEach.call(document.querySelectorAll('[data-popover]'), function (wrap) {
      var trigger = wrap.querySelector('[data-popover-trigger]');
      var panel = wrap.querySelector('[data-popover-panel]');
      if (!trigger || !panel) return;
      function set(open) {
        wrap.classList.toggle('is-open', open);
        trigger.setAttribute('aria-expanded', String(open));
      }
      trigger.addEventListener('click', function () {
        var open = !wrap.classList.contains('is-open');
        set(open);
        if (open) {
          var first = panel.querySelector('a');
          if (first && trigger.matches(':focus-visible')) first.focus();
        }
      });
      trigger.addEventListener('keydown', function (event) {
        if (event.key === 'ArrowDown') {
          event.preventDefault();
          set(true);
          var first = panel.querySelector('a');
          if (first) first.focus();
        }
      });
      wrap.addEventListener('focusout', function (event) {
        if (!wrap.contains(event.relatedTarget)) set(false);
      });
      document.addEventListener('click', function (event) {
        if (!wrap.contains(event.target)) set(false);
      });
      document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape' && wrap.classList.contains('is-open')) {
          set(false);
          trigger.focus();
        }
      });
    });
  }

  /* ---------- Mobile drawer ---------- */
  function initDrawer() {
    var drawer = document.querySelector('[data-drawer]');
    var openers = document.querySelectorAll('[data-drawer-open]');
    if (!drawer || !openers.length) return;
    var closeBtn = drawer.querySelector('[data-drawer-close]');
    var lastFocus = null;

    function focusables() {
      return Array.prototype.filter.call(
        drawer.querySelectorAll('a[href], button, input, summary, [tabindex]:not([tabindex="-1"])'),
        function (el) { return el.offsetParent !== null || el === document.activeElement; }
      );
    }
    function buildNav() {
      var target = drawer.querySelector('[data-drawer-nav]');
      if (!target || target.childElementCount) return;
      Array.prototype.forEach.call(document.querySelectorAll('.primary-nav [data-mega]'), function (item) {
        var details = document.createElement('details');
        details.className = 'drawer-group';
        var summary = document.createElement('summary');
        summary.textContent = item.querySelector('[data-mega-trigger]').textContent.trim();
        var chev = item.querySelector('[data-mega-trigger] svg');
        if (chev) summary.appendChild(chev.cloneNode(true));
        details.appendChild(summary);
        var ul = document.createElement('ul');
        Array.prototype.forEach.call(item.querySelectorAll('.mega-cta, .mega-link, .mega-more a'), function (a, i) {
          var li = document.createElement('li');
          var link = document.createElement('a');
          link.href = a.getAttribute('href');
          var strong = a.querySelector('strong');
          link.textContent = (strong ? strong.textContent : a.textContent).trim();
          if (i === 0) link.className = 'drawer-hub';
          li.appendChild(link);
          ul.appendChild(li);
        });
        details.appendChild(ul);
        target.appendChild(details);
      });
    }
    function open(event) {
      if (event) event.preventDefault();
      buildNav();
      lastFocus = document.activeElement;
      drawer.hidden = false;
      document.body.classList.add('drawer-open');
      Array.prototype.forEach.call(openers, function (o) { o.setAttribute('aria-expanded', 'true'); });
      if (closeBtn) closeBtn.focus();
    }
    function close() {
      drawer.hidden = true;
      document.body.classList.remove('drawer-open');
      Array.prototype.forEach.call(openers, function (o) { o.setAttribute('aria-expanded', 'false'); });
      if (lastFocus && lastFocus.focus) lastFocus.focus();
    }
    Array.prototype.forEach.call(openers, function (o) {
      o.setAttribute('role', 'button');
      o.addEventListener('click', open);
    });
    if (closeBtn) closeBtn.addEventListener('click', close);
    drawer.addEventListener('keydown', function (event) {
      if (event.key === 'Escape') { close(); return; }
      if (event.key !== 'Tab') return;
      var list = focusables();
      if (!list.length) return;
      var first = list[0];
      var last = list[list.length - 1];
      if (event.shiftKey && document.activeElement === first) { event.preventDefault(); last.focus(); }
      else if (!event.shiftKey && document.activeElement === last) { event.preventDefault(); first.focus(); }
    });
    desktop.addEventListener && desktop.addEventListener('change', function (e) { if (e.matches && !drawer.hidden) close(); });
  }

  /* ---------- Forms: client hints + loading state ---------- */
  function initForms() {
    var summary = document.querySelector('[data-error-summary]');
    if (summary) summary.focus();
    var success = document.querySelector('[data-success-focus]');
    if (success) success.focus();

    Array.prototype.forEach.call(document.querySelectorAll('form[data-enhance]'), enhanceForm);
    window.AcadlyticForms = { enhance: enhanceForm };
  }

  function enhanceForm(form) {
    form.addEventListener('submit', function (event) {
      var firstInvalid = null;
      Array.prototype.forEach.call(form.querySelectorAll('[required]'), function (field) {
        var msg = '';
        if (field.type === 'checkbox' ? !field.checked : !field.value.trim()) {
          msg = field.getAttribute('data-required-msg') || (field.type === 'checkbox' ? 'Please confirm to continue.' : 'This field is required.');
        } else if (field.type === 'email' && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(field.value.trim())) {
          msg = field.getAttribute('data-invalid-msg') || 'Please enter a valid email address.';
        }
        showFieldError(field, msg);
        if (msg && !firstInvalid) firstInvalid = field;
      });
      if (firstInvalid) {
        event.preventDefault();
        firstInvalid.focus();
        return;
      }
      var btn = form.querySelector('button[type="submit"]');
      if (btn) {
        btn.classList.add('is-loading');
        btn.setAttribute('aria-disabled', 'true');
        btn.setAttribute('aria-busy', 'true');
        var label = btn.getAttribute('data-loading-text');
        if (label) btn.setAttribute('aria-label', label);
      }
    });
    form.addEventListener('input', function (event) {
      var field = event.target;
      if (field.getAttribute('aria-invalid') === 'true' && (field.type === 'checkbox' ? field.checked : field.value.trim())) {
        showFieldError(field, '');
      }
    });
  }

  function showFieldError(field, msg) {
    var id = field.id + '-error';
    var holder = field.closest('.field');
    var existing = document.getElementById(id);
    var described = (field.getAttribute('aria-describedby') || '').split(' ').filter(function (x) { return x && x !== id; });
    if (msg) {
      if (!existing) {
        existing = document.createElement('p');
        existing.className = 'field-error';
        existing.id = id;
        (holder || field.parentNode).appendChild(existing);
      }
      existing.textContent = msg;
      field.setAttribute('aria-invalid', 'true');
      described.push(id);
      if (holder) holder.classList.add('has-error');
    } else {
      if (existing) existing.remove();
      field.removeAttribute('aria-invalid');
      if (holder) holder.classList.remove('has-error');
    }
    if (described.length) field.setAttribute('aria-describedby', described.join(' '));
    else field.removeAttribute('aria-describedby');
  }

  /* ---------- Password visibility ---------- */
  function initPasswordToggles() {
    Array.prototype.forEach.call(document.querySelectorAll('[data-pw-toggle]'), function (btn) {
      var input = document.getElementById(btn.getAttribute('aria-controls'));
      if (!input) return;
      btn.addEventListener('click', function () {
        var show = input.type === 'password';
        input.type = show ? 'text' : 'password';
        btn.setAttribute('aria-pressed', String(show));
        btn.setAttribute('aria-label', show ? 'Hide password' : 'Show password');
        btn.querySelector('[data-eye]').hidden = show;
        btn.querySelector('[data-eye-off]').hidden = !show;
        input.focus();
      });
    });
  }

})();
