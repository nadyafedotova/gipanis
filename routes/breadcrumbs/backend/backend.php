<?php

Breadcrumbs::for('dashboard', function ($trail) {
    $trail->push(__('strings.backend.dashboard.title'), route('dashboard'));
});

Breadcrumbs::for('amz.table-list', function ($trail, $code) {
    $trail->push(__('strings.backend.dashboard.title'), route('amz.table-list', $code));
});
Breadcrumbs::for('amz.rating', function ($trail) {
    $trail->push(__('strings.backend.rating.title'), route('amz.rating'));
});

Breadcrumbs::for('amz.import', function ($trail) {
    $trail->push(__('strings.backend.amz_import.title'), route('amz.import'));
});

Breadcrumbs::for('jtl.table-list', function ($trail, $code) {
    $trail->push(__('strings.backend.dashboard.title'), route('jtl.table-list', $code));
});

require __DIR__.'/auth.php';
require __DIR__.'/log-viewer.php';
