@if(!empty($connections))
  @foreach($connections as $key=>$connection)
    <div class="my-2 shadow text-white bg-dark p-1 connection-rows connection-row{{$connection->id}}">
      <div class="d-flex justify-content-between">
        <table class="ms-1">
          <td class="align-middle">{{$connection->sender_id==auth()->user()->id?$connection->receiver->name:$connection->sender->name}}</td>
          <td class="align-middle"> - </td>
          <td class="align-middle">{{$connection->sender_id==auth()->user()->id?$connection->receiver->email:$connection->sender->email}}</td>
          <td class="align-middle">
        </table>
        <div>
          <button style="width: 220px" onclick="common('{{$connection->sender_id==auth()->user()->id?$connection->receiver->id:$connection->sender->id}}','{{$connection->id}}')"  id="get_connections_in_common_" class="btn btn-primary" type="button"
            data-bs-toggle="collapse" data-bs-target="#collapse_" aria-expanded="false" aria-controls="collapseExample">
            Connections in common (<span class="connection-count{{$connection->id}}">{{count($connection->common_user[$key])}}</span>)
          </button>
          <button id="create_request_btn_" onclick="cancel('{{$connection->id}}')" class="btn btn-danger me-1">Remove Connection</button>
        </div>

      </div>
    </div>
    <div class="common-rows common-row{{$connection->id}}"></div>
  @endforeach
@endif
