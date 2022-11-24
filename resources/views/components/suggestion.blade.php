
@if(!empty($suggesstions) && count($suggesstions)>0)
  @foreach($suggesstions as $suggesstion)
    <div class="my-2 shadow  text-white bg-dark p-1 suggesstion_rows suggesstion-row{{$suggesstion->id}}">
      <div class="d-flex justify-content-between">
            <table class="ms-1">
              <td class="align-middle">{{$suggesstion->name}}</td>
              <td class="align-middle"> - </td>
              <td class="align-middle">{{$suggesstion->email}}</td>
              <td class="align-middle"> 
            </table>
            <div>
              <button id="create_request_btn_" class="btn btn-primary me-1 suggesstion_btn" onclick="connect('{{auth()->user()->id}}','{{$suggesstion->id}}')">Connect</button>
            </div>
      </div>
    </div>
  @endforeach
@endif