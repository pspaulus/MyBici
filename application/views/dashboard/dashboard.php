<style>
	.container-dashboard {
		color: #fff;
	}
</style>
<script src="https://cdn.jsdelivr.net/npm/vue"></script>
<script src="https://cdn.jsdelivr.net/vue.resource/1.3.1/vue-resource.min.js"></script>

<div id="dashboard" class="container-dashboard">
	<div class="row">

	    <div class="col-xs-6 col-sm-3">
	        <div class="panel panel-yellow">
	            <div class="panel-heading">
	                <div class="row">
	                    <div class="col-xs-3">
	                        <i class="fa fa-circle fa-5x"></i>
	                    </div>
	                    <div class="col-xs-9 text-right">
	                        <div class="huge">{{ tickets.generados }}</div>
	                        <div><strong>Generados</strong></div>
	                    </div>
	                </div>
	            </div>

	        </div>
	    </div>

	    <div class="col-xs-6 col-sm-3">
	        <div class="panel panel-primary">
	            <div class="panel-heading">
	                <div class="row">
	                    <div class="col-xs-3">
	                        <i class="fa fa-circle-o fa-5x"></i>
	                    </div>
	                    <div class="col-xs-9 text-right">
	                        <div class="huge">{{ tickets.en_curso }}</div>
	                        <div><strong>En curso</strong></div>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>

	    <div class="col-xs-6 col-sm-3">
	        <div class="panel panel-green">
	            <div class="panel-heading">
	                <div class="row">
	                    <div class="col-xs-3">
	                        <i class="fa fa-check-circle-o fa-5x"></i>
	                    </div>
	                    <div class="col-xs-9 text-right">
	                        <div class="huge">{{ tickets.realizados }}</div>
	                        <div><strong>Realizados</strong></div>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>

	    <div class="col-xs-6 col-sm-3">
	        <div class="panel panel-red">
	            <div class="panel-heading">
	                <div class="row">
	                    <div class="col-xs-3">
	                        <i class="fa fa-times-circle-o fa-5x"></i>
	                    </div>
	                    <div class="col-xs-9 text-right">
	                        <div class="huge">{{ tickets.anulados }}</div>
	                        <div><strong>Anulados</strong></div>
	                    </div>
	                </div>
	            </div>
	        </div>

	    </div>

	</div>
</div>

<script type="text/javascript">
var dashboard = new Vue({
		el: '#dashboard',
		data: {
			tickets: {
				generados: 0,
				en_curso: 0,
				realizados: 0,
				anulados: 0,
			}
		}
	});

	dashboard.$http.get('Ticket/resumenHoy/1').then(function(resp){
			console.log(resp.bodyText);
			console.log(dashboard);
		});
	/*
	setInterval(function(){ 
		console.log('intervalo');
		dashboard.$http.get('Ticket/resumenHoy/1').then(function(resp){
			console.log(resp);
		});

	}, 5000)*/
</script>