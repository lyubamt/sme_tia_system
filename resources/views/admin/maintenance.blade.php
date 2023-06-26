
@extends('layouts.master_test')

@section('css')

<style>
</style>

@endsection

@section('content')
<!-- https://www.kirupa.com/canvas/drawing_text.htm#:~:text=To%20change%20the%20color%20of%20text%20created%20by%20fillText%2C%20use,querySelector(%20%22%23myCanvas%22%20)%3B -->
<!-- {!! $bitMap !!} -->
<!-- https://www.w3resource.com/html5-canvas/html5-canvas-lines.php -->

<div class="card" style="position: fixed;z-ndex: 3;left: 0%;width: 9%;height: 100%;padding: 0px;margin: 0px;" >

  
</div>

<canvas id="myCanvas" style="position: fixed;left: 9%;width: 85%;height: 100%;padding: 0px;margin: 0px;" >


Your browser does not support the HTML canvas.

</canvas>

<div class="card" style="position: fixed;left: 94%;width: 6%;height: 100%;padding: 0px;margin: 0px;" >

  
          <input  name="color" type="color" id="color" value="#fcba03" >
  
</div>

{{ csrf_field() }}
@endsection
@section('js')
<script>
    $(document).ready(function () {

      // alert($('#myCanvas').width()+' : '+$('#myCanvas').height());

      var c = document.getElementById("myCanvas");
      var ctx = c.getContext("2d");
      var x1 = 27;
      var y1 = 0;
      // var x1 = 0;
      // var y1 = 100;
      // var x2 = 300;
      // var y2 = 100;
      // ctx.moveTo(x1,y1);
      // ctx.lineTo(x2,y2);
      // ctx.strokeStyle = 'red';
      // ctx.stroke();

      // var d = document.getElementById("myCanvas");
      // var dtx = d.getContext("2d");
      // var m1 = 0;
      // var n1 = 0;
      // var m1 = 0;
      // var n1 = 50;
      // var m2 = 300;
      // var n2 = 50;
      // dtx.moveTo(m1,n1);
      // dtx.lineTo(m2,n2);
      // dtx.strokeStyle = 'blue';
      // dtx.stroke();

      var color = $('#color').val();

      $('#color').change(function(e){

        color = $('#color').val();

      });


      $('#myCanvas').mouseup(function(e){

        e.preventDefault();

        $('#myCanvas').attr('class','container-fluid');

      });

      $('#myCanvas').mousedown(function(e){

        // alert(window.innerWidth+' : '+window.innerHeight);

        e.preventDefault();

        $('#myCanvas').attr('class','write');
       

      });

      var Vars = [];
     
      var index = 0;
      var iterator = 0;
      $('#myCanvas').mousemove(function (event) {

        if ($('#myCanvas').attr('class') == 'write') {

          var x = event.clientX;
          var y = event.clientY;
          var coords = "X coords: " + x + ", Y coords: " + y;
          var elem = $("<p style='margin-left:"+x+"px;margin-top:"+y+"px;'></p>").text("Text.");
          elem.css('left:'+x+'px;top:'+y+'px;');
          //  $('#coordsDiv').append(elem);
          // console.log("X coordsClient: " + x + ", Y coordsClient: " + y+ "X coordsPage: " + event.pageX + ", Y coordsPage: " + event.pageY+ "X coordsScreen: " + event.screenX + ", Y coordsScreen: " + event.screenY);
          var xBefore = x;

          if (x > 3.93) {
            x = x / 3.93;
          }

          if (y > 4.14) {
            y = y / 4.14;
          }

          var xAfter = x;
          x -= 27;
          console.log(x+' : '+y);
       
          if (iterator == 0) {

            x1 = x;
            y1 = y;

            var x2 = x1 + 1;
            var y2 = y1 + 1;

          }else{

            var x2 = x;
            var y2 = y;

          }

          Vars[index] = c.getContext("2d");
          Vars[index].lineJoin = "round";//or bevel or square
          Vars[index].moveTo(x1,y1);
          Vars[index].lineTo(x2,y2);
          Vars[index].lineWidth = 1;//1-12
          Vars[index].strokeStyle = color;//color ie blue
          Vars[index].lineCap = 'round';//or butt or square
          Vars[index].stroke();

          // console.log(Vars[index]);
          // console.log('X1: '+x+'Y1: '+y+'X2: '+x1+'Y2: '+y1);

          x1 = x2;
          y1 = y2;

          index++;
          iterator++;

          var _token = $('input[name="_token"]').val();

          // $.ajax({
          //     url:"{{ route('main_ajax') }}",
          //     method:"POST",
          //     data:{
          //         x:x,
          //         y:y,
          //         _token:_token
          //     },
          //     success:function ( response ){
          //         // console.log(response.y);
          //         // console.log(response.x);
          //     }
          // });

          //  console.log(coords);
          //  coordsArr[x];
          //  console.log(coordsArr);
          
        }else{
          iterator = 0;
        }

        
      });

      console.log(Vars);

      var coordsArr = {!! json_encode($coordinates) !!};

      coordsArr.forEach(coordsArrLoop);

      function coordsArrLoop(item,index){

        // var x2 = item.x_coords;
        // var y2 = item.y_coords;

        // if (x2 > 300) {
        //   x2 = x2 % 300;
        // }

        // if (y2 > 300) {
        //   y2 = y2 % 300;
        // }

        // Vars[index] = c.getContext("2d");
        // Vars[index].moveTo(x1,y1);
        // Vars[index].lineTo(x2,y2);
        // Vars[index].stroke();

        // console.log(Vars[index]);

        // x1 = x2;
        // y1 = y2;

      }

      // alert(coordsArr);

    });
</script>
@endsection

