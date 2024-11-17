<div class="wsus__dashboard_menu">
    <div class="wsusd__dashboard_user">
        <img src="{{ auth('web')->user()->profile->image_url }}" alt="img" class="img-fluid">
        <p>{{ auth('web')->user()->profile->first_name . ' ' . auth('web')->user()->profile->last_name ?? auth('web')->user()->name  }}</p>
    </div>
</div>
