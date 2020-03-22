<div id="{{ $alert_id ?? '' }}" class="alert alert-{{ $alert_type ?? 'success' }} alert-dismissible fade show">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
    </button>
    {{ $alert_message ?? '' }}
</div>
