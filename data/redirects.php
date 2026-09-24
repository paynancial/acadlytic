<?php
/**
 * Permanent (301) redirects.
 *
 * - Duplicate-intent URLs from the 120+ page build point to the single
 *   canonical page covering that topic, so no existing link breaks.
 * - Phase 2 handoff URLs point to the matching live page.
 * - Legacy .php URLs from the first starter package.
 *
 * bin/build.php writes a redirect stub for every directory-style source so
 * redirects work even where mod_rewrite is unavailable.
 */
declare(strict_types=1);

return [
    // 120+ page build: duplicate hubs / same-intent pages
    '/platform/platform/'           => '/platform/',
    '/core/platform/'               => '/platform/',
    '/core/ai-platform/'            => '/ai/',
    '/resources/resources/'         => '/resources/',
    '/company/resources-center/'    => '/resources/',
    '/company/company/'             => '/company/',
    '/resources/crm-vs-erp/'        => '/comparisons/academic-crm-vs-erp/',
    '/industries/universities/'     => '/solutions/for-universities/',
    '/industries/colleges/'         => '/solutions/for-colleges/',
    '/ai/ai-automation/'            => '/ai/ai-workflows/',

    // Phase 2 handoff: features
    '/features/'                              => '/platform/',
    '/features/ai-admissions/'                => '/ai/ai-for-admissions/',
    '/features/student-engagement/'           => '/platform/student-engagement/',
    '/features/student-risk-prediction/'      => '/ai/ai-for-student-success/',
    '/features/personalized-recommendations/' => '/ai/ai-personalization/',
    '/features/automated-workflows/'          => '/platform/workflow-automation/',
    '/features/real-time-reporting/'          => '/platform/reports-insights/',
    '/features/enrollment-analytics/'         => '/platform/enrollment-analytics/',
    '/features/application-tracking/'         => '/platform/application-management/',
    '/features/document-management/'          => '/platform/electronic-document-sharing/',
    '/features/communication-hub/'            => '/platform/communication-hub/',
    '/features/academic-reporting/'           => '/platform/reports-insights/',
    '/features/parent-communication/'         => '/solutions/for-parents/',

    // Phase 2 handoff: use cases
    '/use-cases/'                                            => '/solutions/',
    '/use-cases/crm-for-universities/'                       => '/solutions/for-universities/',
    '/use-cases/crm-for-colleges/'                           => '/solutions/for-colleges/',
    '/use-cases/ai-for-higher-education/'                    => '/resources/ai-in-higher-education-guide/',
    '/use-cases/academic-management-for-universities/'       => '/solutions/for-universities/',
    '/use-cases/academic-management-for-colleges/'           => '/solutions/for-colleges/',
    '/use-cases/student-management-for-higher-education/'    => '/platform/student-management/',
    '/use-cases/admissions-management-for-higher-education/' => '/platform/admissions-crm/',
    '/use-cases/education-analytics-platform/'               => '/platform/reports-insights/',
    '/use-cases/cloud-academic-management/'                  => '/core/cloud-platform/',

    // Phase 2 handoff: integrations, resources, glossary, comparisons
    '/integrations/api-integration/'                     => '/integrations/api/',
    '/resources/education-analytics-guide/'              => '/resources/academic-analytics-guide/',
    '/resources/ai-in-higher-education/'                 => '/resources/ai-in-higher-education-guide/',
    '/resources/academic-automation-guide/'              => '/resources/education-automation-guide/',
    '/resources/education-crm-vs-erp/'                   => '/comparisons/academic-crm-vs-erp/',
    '/glossary/academic-automation/'                     => '/glossary/workflow-automation/',
    '/comparisons/academic-crm-vs-spreadsheet/'          => '/comparisons/spreadsheets-vs-academic-platform/',
    '/comparisons/cloud-vs-on-premise-academic-software/' => '/comparisons/cloud-vs-on-premise-education/',

    // Phase 2 handoff: company, trust, demo
    '/company/contact/'  => '/core/contact/',
    '/request-demo/'     => '/company/request-demo/',
    '/trust/security/'   => '/core/security/',
    '/security/'         => '/core/security/',
    '/privacy/'          => '/trust/privacy/',
    '/terms/'            => '/trust/terms/',
    '/about/'            => '/core/about/',
    '/contact/'          => '/core/contact/',
    '/pricing/'          => '/core/pricing/',
    '/support/'          => '/company/support/',
    '/demo/'             => '/company/request-demo/',
    '/about-us/'         => '/core/about/',
    '/contact-us/'       => '/core/contact/',
    '/blog/'             => '/resources/blog/',
    '/news/'             => '/company/news/',
    '/leadership/'       => '/company/leadership/',
    '/team/'             => '/company/team/',
    '/vision-and-mission/' => '/company/vision-mission/',
    '/vision-mission/'   => '/company/vision-mission/',

    // Legacy starter-package .php URLs
    '/about.php'     => '/core/about/',
    '/contact.php'   => '/core/contact/',
    '/blog.php'      => '/resources/blog/',
    '/resources.php' => '/resources/',
    '/help.php'      => '/company/support/',
    '/careers.php'   => '/company/careers/',
    '/partners.php'  => '/company/partners/',
    '/privacy.php'   => '/trust/privacy/',
    '/terms.php'     => '/trust/terms/',
];
