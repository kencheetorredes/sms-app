@foreach ($lists as $list)
    <a href="#" class="seeMessages" data-target=".chat" data-url="{{ route('otp.view',[$list->number, $twilio_number]) }}">
    <div class="users-list-body">
        <div>
            <h5>{{ isset($list->contact->name) ? $list->contact->name :  $list->number }}</h5>
        </div>
        <div class="last-chat-time">
            <small class="text-muted">{{ date('d',strtotime($list->created_at)) == date('d') ? date('H:s A',strtotime($list->created_at)) :  $list->created_at }}</small>
        </div>    
</div>
    </a>
@endforeach