<div class="row justify-content-center mt-5">
  <div class="col-12">
    <div class="card shadow  text-white bg-dark">
      <div class="card-header">Coding Challenge - Network connections</div>
      <div class="card-body">
        <div class="btn-group w-100 mb-3 nav nav-tabs" id="myTab" role="tablist" aria-label="Basic radio toggle button group">
          <input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off" checked>
          <label class="btn btn-outline-primary" onclick="getSuggesstions(0,10,'onload')" id="suggesstion-tab" data-toggle="tab" href="#suggesstion" role="tab" aria-controls="suggesstion" aria-selected="false" for="btnradio1">Suggestions (<span id="suggesstion_count">0</span>)</label>

          <input type="radio" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off">
          <label class="btn btn-outline-primary" onclick="getSentRequest(0,10,'onload')" id="sent-tab" data-toggle="tab" href="#sent" role="tab" aria-controls="sent" aria-selected="false" for="btnradio2">Sent Requests (<span id="sent_count">0</span>)</label>

          <input type="radio" class="btn-check" name="btnradio" id="btnradio3" autocomplete="off">
          <label class="btn btn-outline-primary" onclick="getReceiveRequest(0,10,'onload')"  id="received-tab" data-toggle="tab" href="#received" role="tab" aria-controls="received" aria-selected="false" for="btnradio3">Received
            Requests(<span id="receive_count">0</span>)</label>

          <input type="radio" class="btn-check" name="btnradio" id="btnradio4" autocomplete="off">
          <label class="btn btn-outline-primary" onclick="getConnected(0,10,'onload')" id="connection-tab" data-toggle="tab" href="#connection" role="tab" aria-controls="connection" aria-selected="false" for="btnradio4">Connections (<span id="connection_count">0</span>)</label>
        </div>

        <div class="tab-content" id="myTabContent">
        <div id="loading">
          <x-skeleton/>
        </div>
        <div class="tab-pane fade active show" id="suggesstion" role="tabpanel" aria-labelledby="suggesstion-tab">
        <div id="suggesstion-data"></div>
        <div class="d-flex justify-content-center mt-2 py-3  {{-- d-none --}}">
          <button class="btn btn-primary suggesstion-load-more"  onclick="loadMore('suggesstion-data')" >Load more</button>
        </div>
        </div>
        <div class="tab-pane fade" id="sent" role="tabpanel" aria-labelledby="sent-tab">
        <div id="sent-data"></div>
        <div class="d-flex justify-content-center mt-2 py-3 {{-- d-none --}}">
          <button class="btn btn-primary sent-load-more" onclick="loadMore('sent-data')" >Load more</button>
        </div>
        </div>
        <div class="tab-pane fade" id="received" role="tabpanel" aria-labelledby="received-tab">
        <div id="received-data"></div>
        <div class="d-flex justify-content-center mt-2 py-3 {{-- d-none --}}" >
          <button class="btn btn-primary receive-load-more" onclick="loadMore('received-data')" >Load more</button>
        </div>
        </div>
        <div class="tab-pane fade" id="connection" role="tabpanel" aria-labelledby="connection-tab">
        <div id="connected-data"></div>
        <div class="d-flex justify-content-center mt-2 py-3 {{-- d-none --}}" >
          <button class="btn btn-primary connection-load-more" onclick="loadMore('connected-data')" >Load more</button>
        </div>
        </div>

      </div>
    </div>
  </div>
</div>
