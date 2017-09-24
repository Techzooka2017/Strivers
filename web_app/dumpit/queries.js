$(document).ready(function(){
			
			$(".tmp_form").submit(function(e){
			    return false;
			});
			$("button#btnspam").click(function(){
				$(this).hide();
				$(this).siblings('img[name=wait]').css({display:"block"});
				var fs_value = $(this).siblings('input[name=fs]').val();
			    $.ajax({
			    	type: "POST",
			    	url: "query.php",
			    	data : {'fs':fs_value,'spam':true},
			    	success: function(result){
			        	$('div.div-'+fs_value).fadeOut("slow").promise().done(function(){
			        		$(this).remove();
			        	});
			    }});
			});
			$("button#btn").click(function(){
				btnObj=this;
				$(this).siblings('img[name=wait]').css({display:"block"});
				var f0_value = $(this).siblings('input[name=f0]').val();
			    $.ajax({
			    	type: "POST",
			    	url: "query.php",
			    	data : {'f0':f0_value,'done':true},
			    	success: function(result){
			        	$(btnObj).siblings('img[name=wait]').css({display:"none"});
			        	$(btnObj).attr('disabled',true);
			        	$(btnObj).removeClass("btn-default");
			        	$(btnObj).addClass("btn-success");
			        	$('div.div-'+f0_value).fadeOut("slow").promise().done(function(){
			        		$(this).remove();
			        	});
			    }});
			});

			$("button#btnconfirm").click(function(){
				btnObj=this;
				$(this).siblings('img[name=wait]').css({display:"block"});
				var f0_value = $(this).siblings('input[name=fs]').val();
			    $.ajax({
			    	type: "POST",
			    	url: "query.php",
			    	data : {'f0':f0_value,'confirm':true},
			    	success: function(result){
			        	$(btnObj).siblings('img[name=wait]').css({display:"none"});
			        	$(btnObj).attr('disabled',true);
			        	$(btnObj).removeClass("btn-default");
			        	$(btnObj).addClass("btn-success");
			        	$('div.div-'+f0_value).fadeOut("slow").promise().done(function(){
			        		$(this).remove();
			        	});
			    }});
			});

			$("button#btnreject").click(function(){
				btnObj=this;
				$(this).siblings('img[name=wait]').css({display:"block"});
				var f0_value = $(this).siblings('input[name=fr]').val();
			    $.ajax({
			    	type: "POST",
			    	url: "query.php",
			    	data : {'f0':f0_value,'reject':true},
			    	success: function(result){
			        	$(btnObj).siblings('img[name=wait]').css({display:"none"});
			        	$(btnObj).attr('disabled',true);
			        	$(btnObj).removeClass("btn-default");
			        	$(btnObj).addClass("btn-success");
			        	$('div.div-'+f0_value).fadeOut("slow").promise().done(function(){
			        		$(this).remove();
			        	});
			    }});
			});

			$("button#btnsubmit").click(function(){
				btnObj=this;
				$(this).siblings('img[name=wait]').css({display:"block"});
				var fc_value = $(this).siblings('textarea[name=comments]').val();
				var ft_value = $(this).siblings('input[name=ft]').val();
			    $.ajax({
			    	type: "POST",
			    	url: "query.php",
			    	data : {'comments':fc_value,'ft':ft_value,'submit':true},
			    	success: function(result){
			        	$(btnObj).siblings('img[name=wait]').css({display:"none"});
			        	$(btnObj).siblings('input[name=comments]').text(fc_value);
			    }});
			});
			$("button#btnundos").click(function(){
				$(this).hide();
				$(this).siblings('img[name=wait]').css({display:"block"});
				var fus_value = $(this).siblings('input[name=fus]').val();
			    $.ajax({
			    	type: "POST",
			    	url: "query.php",
			    	data : {'fus':fus_value,'undos':true},
			    	success: function(result){
			        	$('div.div-'+fus_value).fadeOut("slow").promise().done(function(){
			        		$(this).remove();
			        	});
			    }});
			});

			$("button#btnrm").click(function(){
				$(this).hide();
				$(this).siblings('img[name=wait]').css({display:"block"});
				var fr_value = $(this).siblings('input[name=fr]').val();
			    $.ajax({
			    	type: "POST",
			    	url: "query.php",
			    	data : {'fr':fr_value,'remove':true},
			    	success: function(result){
			        	$('div.div-'+fr_value).fadeOut("slow").promise().done(function(){
			        		$(this).remove();
			        	});
			    }});
			});

			$("button#btnundod").click(function(){
				$(this).hide();
				$(this).siblings('img[name=wait]').css({display:"block"});
				var fud_value = $(this).siblings('input[name=fud]').val();
			    $.ajax({
			    	type: "POST",
			    	url: "query.php",
			    	data : {'fud':fud_value,'undod':true},
			    	success: function(result){
			        	$('div.div-'+fud_value).fadeOut("slow").promise().done(function(){
			        		$(this).remove();
			        	});
			    }});
			});
		});