<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script>
	$(document).ready(function(){
		$(".poisto_form").submit(function(evt){
			var varmistus = confirm("Haluatko varmasti poistaa?");
			if(!varmistus) {
				evt.preventDefault();
			}
                
		});
	});
        $(document).ready(function(){
                $(".muokkaus_form").submit(function(evt){
                        var varmistus = confirm("Haluatko varmasti muokata?");
                        if(!varmistus) {
                                evt.preventDefault();
                        }

                });
        });
</script>
