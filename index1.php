<?php require('require/header.php'); ?>
<?php
$api_key = 'aa16a2d93627e7cb4ff8e957553050fb';
$tag = 'coffee';
$perPage = 18;

$url = 'https://api.flickr.com/services/rest/?method=flickr.photos.search';
$url.= '&api_key='.$api_key;
$url.= '&tags='.$tag;
$url.= '&per_page='.$perPage;
$url.= '&format=json';
$url.= '&nojsoncallback=1';
$url.= '&page=1';

$response = json_decode(file_get_contents($url));
$photo_array = $response->photos->photo;

?>

  <body>
    <div class="container">
        <div class="row" style="text-align:center; border-bottom:1px dashed #ccc;  padding:0 0 20px 0; margin-bottom:40px;">
            <h3 style="font-family:'Bree Serif', arial; font-weight:bold; font-size:30px;">
                Update/Develop by: yunoa_12@yahoo.com for exam porpose only.
            </h3>
            <p>Coffee is a brewed drink prepared from roasted coffee beans, which are the seeds of berries from the Coffea plant. The plant is native to subtropical Africa and some islands in southern Asia.</p>
        </div>

        <ul class="row">
		<?php
		$x = 0;
		foreach($photo_array as $single_photo){
		
			$farm_id = $single_photo->farm;
			$server_id = $single_photo->server;
			$photo_id = $single_photo->id;
			$secret_id = $single_photo->secret;
			$size = 'm';
			
			$title = $single_photo->title;

			$photo_url = 'https://farm'.$farm_id.'.staticflickr.com/'.$server_id.'/'.$photo_id.'_'.$secret_id.'_'.$size.'.'.'jpg';
			
			
			$li = '';
			$li .= '<li class="col-lg-2 col-md-2 col-sm-3 col-xs-4 col-xxs-12">';
            $li .= '    <img class="img-responsive" src="'.$photo_url.'" >';
            if($title!='') $li .= '    <div class="text">'.$title . '</div>';
            $li .= '</li>';
			

			
			echo $x%6==3 || $x%6==4 ? '<li class="clearfix visible-xs-block"></li>':'';
			echo $x%6==0 ? '<li class="clearfix visible-lg-block  visible-md-block visible-xs-block"></li>':'';
			echo $li;
			$x++;
		}
		?>
        </ul>
    </div> <!-- /container -->


    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-body">
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
  
	<script src="js/debug.js"></script>
	<script src="js/jquery.infinitescroll.min.js"></script>
	<script src="js/manual-trigger.js"></script>
	<script>
	
	var x = 2;
	$('#content').infinitescroll({
		navSelector  	: "#next:last",
		nextSelector 	: "a#next:last",
		itemSelector 	: "#content p",
		debug		 	: true,
		dataType	 	: 'html',
        maxPage         : 3,
		path: ["http://nuvique/infinite-scroll/test/index", ".html?a="+x]
    }, function(newElements, data, url){
		x++;	
    });
	</script>
  </body>

</html>
