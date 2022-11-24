@extends('layouts.app')

@section('content')

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script src="{{ asset('js/helper.js') }}?v={{ time() }}" defer></script>
  <script src="{{ asset('js/main.js') }}?v={{ time() }}" defer></script>

  <div class="container">
    <x-dashboard />
    <x-network_connections :data='$data'/>

  </div>

@endsection
@section('script')
<script>
  var suggesstion_offset=0;
  var suggesstion_limit =10;
  var suggesstion_count = 0;
  var sent_offset=0;
  var sent_limit =10;
  var sent_count=0;
  var receive_offset=0;
  var receive_limit =10;
  var receive_count=0;
  var connection_offset=0;
  var connection_limit =10;
  var connection_count=0;

  $(document).ready(function(){
    getSuggesstions(suggesstion_offset,suggesstion_limit);
    getSentRequest(sent_offset,sent_limit);
    getReceiveRequest(receive_offset,receive_limit);
    getConnected(connection_offset,connection_limit);
  });
  function getSuggesstions(offset,limit,type=null){
    $.ajax({
        type:'Post',
        url:"{{route('getSuggesstions')}}",
        data:{offset:offset,limit:limit, _token: "{{ csrf_token() }}"},
        beforeSend: function() {
          $("#loading").show();
        },
        success:function(data){
          if(data.status==true){
            $('#suggesstion_count').html(data.count);
            suggesstion_count = data.count;
            if(type!=null){
              suggesstion_offset=0;
              suggesstion_limit =10;
              $('#suggesstion-data').html(data.data);
            }else{
              $('#suggesstion-data').append(data.data);
            }
          }
          var rows_count=$(".suggesstion_rows").length;
            load_button(data.count,rows_count,'suggesstion-load-more');
          $("#loading").hide();

        }
    });
  }
  function getSentRequest(offset,limit,type=null){
    $.ajax({
        type:'Post',
        url:"{{route('getSentRequest')}}",
        data:{offset:offset,limit:limit, _token: "{{ csrf_token() }}"},
        beforeSend: function() {
          $("#loading").show();
        },
        success:function(data){
          if(data.status==true){
            $('#sent_count').html(data.count);
            sent_count = data.count;
            if(type!=null){
              sent_offset=0;
              sent_limit =10;
              $('#sent-data').html(data.data);
            }else{
              $('#sent-data').append(data.data);
            }

          }
          var rows_count=$(".sent-rows").length;
            load_button(data.count,rows_count,'sent-load-more');
          $("#loading").hide();
        }
    });
  }
  function getReceiveRequest(offset,limit,type=null){
    $.ajax({
        type:'Post',
        url:"{{route('getReceiveRequest')}}",
        data:{offset:offset,limit:limit, _token: "{{ csrf_token() }}"},
        beforeSend: function() {
          $("#loading").show();
        },
        success:function(data){
          if(data.status==true){
            $('#receive_count').html(data.count);
            receive_count = data.count;
            if(type!=null){
              receive_offset=0;
              receive_limit =10;
              $('#received-data').html(data.data);
            }else{
              $('#received-data').append(data.data);
            }
          }
          var rows_count=$(".receive-rows").length;
          load_button(data.count,rows_count,'receive-load-more');
          $("#loading").hide();
        }
    });
  }
  function getConnected(offset,limit,type=null){
    $.ajax({
        type:'Post',
        url:"{{route('getConnected')}}",
        data:{offset:offset,limit:limit, _token: "{{ csrf_token() }}"},
        beforeSend: function() {
          $("#loading").show();
        },
        success:function(data){
          console.log(data.data);
          if(data.status==true){
            $('#connection_count').html(data.count);
              connection_count = data.count;
            if(type!=null){
              connection_offset=0;
              connection_limit =10;
              $('#connected-data').html(data.data);
            }else{
              $('#connected-data').append(data.data);
            }
          }
          var rows_count=$(".connection-rows").length;
            load_button(data.count,rows_count,'connection-load-more');
          $("#loading").hide();
        }
    });
  }
  function common(id,row_id){
    $.ajax({
        type:'Post',
        url:"{{route('getCommon')}}",
        data:{id:id, _token: "{{ csrf_token() }}"},
        beforeSend: function() {
          $("#loading").show();
        },
        success:function(data){
          if(data.status==true){
            $('.common-rows').html('');
            $('.common-row'+row_id).html(data.data);
          }
          $("#loading").hide();
        }
    });
  }
  function loadMore(id){
      if(id=='suggesstion-data'){
        suggesstion_offset = suggesstion_offset + 10;
        suggesstion_limit =  10;
        getSuggesstions(suggesstion_offset,suggesstion_limit);
      }
      if(id=='sent-data'){
        sent_offset = sent_offset + 10;
        sent_limit =  10;
        getSentRequest(sent_offset,sent_limit);
      }
      if(id=='received-data'){
        receive_offset = receive_offset + 10;
        receive_limit =  10;
        getReceiveRequest(receive_offset,receive_limit);
      }
      if(id=='connected-data'){
        connection_offset = receive_offset + 10;
        connection_limit =  10;
        getConnected(connection_offset,connection_limit);
      }
  }
  function connect(userId, suggesstionId) {
    $.ajax({
      type:'POST',
      url:"{{route('sendRequest')}}",
      data:{userId:userId, suggesstionId:suggesstionId, _token: "{{ csrf_token() }}"},
      beforeSend: function() {
          $("#loading").show();
        },
      success:function(data){
        if(data.status==true){
          suggesstion_count = suggesstion_count-1;
          $('#suggesstion_count').html(suggesstion_count);
          sent_count = sent_count+1;
          $('#sent_count').html(sent_count);
          $('.suggesstion-row'+suggesstionId).remove();
        }
        $("#loading").hide();
      }
    });
  }
  function withdraw(id) {
    $.ajax({
      type:'POST',
      url:"{{route('withdrawRequest')}}",
      data:{id:id, _token: "{{ csrf_token() }}"},
      beforeSend: function() {
          $("#loading").show();
        },
      success:function(data){
        if(data.status==true){
          sent_count = sent_count-1;
          $('#sent_count').html(sent_count);
          suggesstion_count = suggesstion_count+1;
          $('#suggesstion_count').html(suggesstion_count);
          $('.request-row'+id).remove();
        }
        $("#loading").hide();
      }
    });
  }
  function accept(id) {
    $.ajax({
      type:'POST',
      url:"{{route('acceptRequest')}}",
      data:{id:id, _token: "{{ csrf_token() }}"},
      beforeSend: function() {
          $("#loading").show();
        },
      success:function(data){
        if(data.status==true){
          receive_count = receive_count-1;
          $('#receive_count').html(receive_count);
          connection_count = connection_count+1;
          $('#connection_count').html(connection_count);
          $('.request-row'+id).remove();
        }
        $("#loading").hide();
      }
    });
  }
  function cancel(id) {
    $.ajax({
      type:'POST',
      url:"{{route('cancelRequest')}}",
      data:{id:id, _token: "{{ csrf_token() }}"},
      beforeSend: function() {
          $("#loading").show();
        },
      success:function(data){
        if(data.status==true){
          connection_count = connection_count-1;
          $('#connection_count').html(connection_count);
          suggesstion_count = suggesstion_count+1;
          $('#suggesstion_count').html(suggesstion_count);
          $('.connection-row'+id).remove();
        }
        $("#loading").hide();
      }
    });
  }
  function load_button(count,rows_count,button_class){

    if(rows_count==count){
        $("."+button_class).hide();
    }else{
        $("."+button_class).show();
    }
  }
</script>
@endsection
