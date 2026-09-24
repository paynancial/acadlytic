<?php
/**
 * Contact channels: the single source for Acadlytic's phone, WhatsApp and
 * email. Denied over HTTP (config/.htaccess).
 *
 * The full phone number is used ONLY server-side, by the /go/call/ and
 * /go/whatsapp/ redirect endpoints, so it never appears in page HTML, JSON-LD,
 * llms.txt or tel: links. Public UI shows CONTACT_PHONE_DISPLAY.
 */
declare(strict_types=1);

return [
    'CONTACT_PHONE'         => '+918010707171',       // E.164, server-side only
    'CONTACT_PHONE_DISPLAY' => '+91 80••••••71',       // masked, shown in the UI
    'CONTACT_EMAIL'         => 'info@acadlytic.com',
    'WHATSAPP_NUMBER'       => '918010707171',         // digits only, server-side only
    'WHATSAPP_MESSAGE'      => "Hello Acadlytic Team,\nI would like to know more about your AI-powered EdTech CRM and academic management platform.\n\nPlease share more information.",
    // Public, number-free endpoints that redirect to tel: / WhatsApp.
    'CALL_URL'              => '/go/call/',
    'WHATSAPP_URL'          => '/go/whatsapp/',
];
