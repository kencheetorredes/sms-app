@foreach ($lists as $list)
    <a href="#" class="seeMessages" data-target=".chat" data-url="{{ route('message.view',[$list->number,$list->client_id,$twilio_number]  ) }}">
        <div class="users-list-body">
            <div>
                <h5>{{ isset($list->contact->name) ? $list->contact->name :  $list->number }}</h5>
                <p>{{ date('d',strtotime($list->created_at)) == date('d') ? date('H:s A',strtotime($list->created_at)) :  $list->created_at }}</p>
            </div>
               
        </div>
    </a>
@endforeach