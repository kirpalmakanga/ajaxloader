<?php 
function is_ajax_request() {
    if( isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'BAWXMLHttpRequest' ){
        return true;
    }
}

$ajax = is_ajax_request();

if(!$ajax):
?>
<html>
<head>
	<style>
		img {
			display: block;
			max-width: 100%;
			height: auto;
			background-size: cover;
			backface-visibility: hidden;
		}
		
		main {
			opacity: 1;
			transition: opacity 0.5s ease-out;
		}
		main.loading {
			opacity: 0;
		}
	</style>
</head>
<body>
<a href="http://localhost/ajaxloader/?page=<?= (isset($_GET['page']) ? $_GET['page'] + 1 : 1); ?>">go</a>
<button class="load">Load</button>
<main>
<?php endif; ?>

<div>
<h2>Page <?= $_GET['page']; ?></h2>	
<a href="http://localhost/ajaxloader/?page=<?= (isset($_GET['page']) ? $_GET['page'] + 1 : 1); ?>"><img src="http://lorempixel.com/1920/1080/" /></a>
</div>

<?php if(!$ajax): ?>
</main>
<script src="dist/ajaxloader.js"></script>
<script>
	(function() {
		'use strict';

		var ajaxOptions = {
			    wrapper: 'body',
			    container: 'main',
			    anchors: 'a:not([target="_blank"]):not([href="#"])',
			    siteName: 'Your Site Name',
			    beforeLoading: (url, container) => {
			        container.classList.add('loading');
			    },
			    afterLoading: (url, container) => {
					setTimeout(() => {
			        	container.classList.remove('loading');						
					}, 500);
			    },
			    error: (error) => {
			        console.log(error);
			    }
			},
			loadOptions = {
				wrapper: 'body',
			    container: 'main',
			    replaceContent: false,
			    ajaxUrl: 'http://localhost/ajaxloader/',
			    ajaxData: {
			        page: 1
			    },

			    beforeLoading: (url, container) => {
			        container.classList.add('loading');
			    },
			    afterLoading: (url, container, data) => {
					setTimeout(() => {
			        	container.classList.remove('loading');						
					}, 500);
			    },
			    options: ajaxOptions
			},
			button = document.querySelector('.load');

		document.ajaxLoader(ajaxOptions);

		button.addEventListener('click', () => {
			document.ajaxLoader(loadOptions);
		});
	})();
</script>
</body>
</html>
<?php endif; ?>