@if(!empty($requests))
  @foreach($requests as $request)
    <div class="my-2 shadow text-white bg-dark p-1 {{$mode}}-rows request-row{{$request->id}}">
      <div class="d-flex justify-content-between">
        <table class="ms-1">
          <td class="align-middle">{{$mode == 'sent'?$request->receiver->name : $request->sender->name}}</td>
          <td class="align-middle"> - </td>
          <td class="align-middle">{{$mode == 'sent'?$request->receiver->email : $request->sender->email}}</td>
          <td class="align-middle">
        </table>
        <div>
          @if ($mode == 'sent')
            <button id="cancel_request_btn_" class="btn btn-danger me-1"
              onclick="withdraw('{{$request->id}}')">Withdraw Request</button>
          @else
            <button id="accept_request_btn_" class="btn btn-primary me-1"
              onclick="accept('{{$request->id}}')">Accept</button>
          @endif
        </div>
      </div>
    </div>
      @endforeach
@endif
