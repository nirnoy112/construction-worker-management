<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3  style="color: #ffffff;" class="box-title">TEST</h3>
            </div>
            <?php echo form_open('', array("method"=>"post", "enctype"=>"multipart/form-data")); ?>
          	<div class="box-body">
          		<div class="row clearfix">
					<div class="col-sm-12">
						<div class="sp-wrapper">
								<canvas id="test-signature-pad" class="signature-pad" width=400 height=200></canvas>
						</div>
						<br>
						<hr>
						<br>
						<br>
						<button id="save-png">Save as PNG</button>
						<button id="save-jpeg">Save as JPEG</button>
						<button id="save-svg">Save as SVG</button>
						<button id="draw">Draw</button>
						<button id="erase">Erase</button>
						<button id="clear">Clear</button>
					</div>
	          	<div class="box-footer">
	            	<button type="submit" class="btn btn-success">
	            		<i class="fa fa-check"></i> OKAY
	            	</button>
	          	</div>
            	<?php echo form_close(); ?>
      		</div>
    	</div>
	</div>
</div>

<script type="text/javascript">
	
	var canvas = document.getElementById('test-signature-pad');

    // Adjust canvas coordinate space taking into account pixel ratio,
    // to make it look crisp on mobile devices.
    // This also causes canvas to be cleared.
    function resizeCanvas() {
        // When zoomed out to less than 100%, for some very strange reason,
        // some browsers report devicePixelRatio as less than 1
        // and only part of the canvas is cleared then.
        var ratio =  Math.max(window.devicePixelRatio || 1, 1);
        canvas.width = canvas.offsetWidth * ratio;
        canvas.height = canvas.offsetHeight * ratio;
        canvas.getContext("2d").scale(ratio, ratio);
    }

    window.onresize = resizeCanvas;
    resizeCanvas();

    var signaturePad = new SignaturePad(canvas, {
      backgroundColor: 'rgb(255, 255, 255)' // necessary for saving image as JPEG; can be removed is only saving as PNG or SVG
    });

    document.getElementById('save-png').addEventListener('click', function () {
      if (signaturePad.isEmpty()) {
        return alert("Please provide a signature first.");
      }
      
      var data = signaturePad.toDataURL('image/png');
      console.log(data);
      window.open(data);
    });

    document.getElementById('save-jpeg').addEventListener('click', function () {
      
		//alert('Okay if you see this. !!!');
      /*if (signaturePad.isEmpty()) {
        return alert("Please provide a signature first.");
      }*/

      var data = signaturePad.toDataURL('image/jpeg');
      console.log(data);
      //window.open(data);
    });

    document.getElementById('save-svg').addEventListener('click', function () {
      if (signaturePad.isEmpty()) {
        return alert("Please provide a signature first.");
      }

      var data = signaturePad.toDataURL('image/svg+xml');
      console.log(data);
      console.log(atob(data.split(',')[1]));
      window.open(data);
    });

    document.getElementById('clear').addEventListener('click', function () {
      signaturePad.clear();
    });

    document.getElementById('draw').addEventListener('click', function () {
      var ctx = canvas.getContext('2d');
      console.log(ctx.globalCompositeOperation);
      ctx.globalCompositeOperation = 'source-over'; // default value
    });

    document.getElementById('erase').addEventListener('click', function () {
      var ctx = canvas.getContext('2d');
      ctx.globalCompositeOperation = 'destination-out';
    });

</script>