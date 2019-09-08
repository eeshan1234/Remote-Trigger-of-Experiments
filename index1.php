<html>
<head>
    <meta charset="utf-8">
<base target="dashbd">
   
    <script src="https://cdn.zingchart.com/zingchart.min.js"></script>
    <script src="jquery-3.4.1.min.js"></script>
 <style>
        html,
        body {
            height: 100%;
            width: 100%;
            margin: 0;
            padding: 0;
            background-color:grey;
        }
 
#play{
margin-top:20px;
margin-left:30px;
width:100px;
height:35px;
background-color:green;

}       

 #myChart {
            margin: 0 auto;
            height: 380px;
            width: 98%;
            box-shadow: 5px 5px 5px #eee;
            background-color: #fff;
            border: 1px solid #eee;
            display: flex;
            flex-flow: column wrap;
        }
 
        .controls--container {
            display: flex;
            align-items: center;
            justify-content: center;
        }
 
        .controls--container button {
            margin: 40px;
            padding: 15px;
            background-color: #FF4081;
            border: none;
            color: #fff;
            box-shadow: 5px 5px 5px #eee;
            font-size: 16px;
            font-family: Roboto;
            cursor: pointer;
            transition: .1s;
        }

        /*button movement*/
        .controls--container button:active {
            border-width: 0 0 2px 0;
            transform: translateY(8px);
            opacity: 0.9;
        }
 
        .zc-ref {
            display: none;
        }
 
        zing-grid[loading] {
            height: 380px;
        }
        #slider{
        margin-left:40px;
        color:black;
        }
        #lb{
        margin-left:30px;
        }
        
        
    </style>
</head>
<body>
    <!-- CHART CONTAINER -->
    <div id="myChart">
        <a class="zc-ref" href="https://www.zingchart.com"></a>
    </div>
    <div class="controls--container">
       
        <span id="output"></span>
    </div>
<button id="play" onclick="start()">Start</button><br><br>
<label id="lb">Length: </label><input id="slider" type="range" min="55" max="80">

<script>

function start(){
   
var flag="h";
var len=document.getElementById("slider").value;
//alert("Executed");
//dashbd.location.href='cgi-bin/gcs.py?'+flag;
$.ajax({
type:"POST",
url:"/cgi-bin/gcs.py?flag="+flag+"&len="+len,
});
//document.location.reload(true);
//document.getElementById("lb").value=len;
}
	var ajax=new XMLHttpRequest();
	var method="GET";
	var url="enc5.php";
	var async=true;
	ajax.open(method,url,async);
	ajax.send();
	var data;
	ajax.onreadystatechange=function()
	{
		 data = JSON.parse(this.responseText);
                 console.log(data);
		var html="";
		for(var a=0;a<20;a++)
		{
			var name=data[a].name;
			console.log(name);



		}

	}

                         function realTimeFeed(callback) {
                         var tick = {};
                                        //console.log(name);
				for(var a=data.length-500;a<=data.length;a=a+250){
                                tick.plot0 =  parseInt(data[a].name, 10);
                              //tick.plot0 = parseInt(10 + 90 * Math.random(), 10);
                                callback(JSON.stringify(tick)); }
                                
                     };
                 
 

        // define top level feed control functions

        function randomizeInterval() {
        }
        // window.onload event for Javascript to run after HTML
        // because this Javascript is injected into the document head
        window.addEventListener('load', () => {
            // Javascript code to execute after DOM content
 

 
            // full ZingChart schema can be found here:
            // https://www.zingchart.com/docs/api/json-configuration/
            const myConfig = {
                //chart styling
                type: 'line',
                globals: {
                    fontFamily: 'Roboto',
                },
                backgroundColor: '#000',
                title: {
                    backgroundColor: '#1565C0',
                    text: 'Reconfigurable  Simple  Pendulum',
                    color: '#fff',
                    height: '30x',
                },
                plotarea: {
                    marginTop: '80px'
                },
                crosshairX: {
                    lineWidth: 4,
                    lineStyle: 'dashed',
                    lineColor: '#424242',
                    marker: {
                        visible: true,
                        size: 9
                    },
                    plotLabel: {
                        backgroundColor: '#000',
                        borderColor: '#e3e3e3',
                        borderRadius: 5,
                        padding: 15,
                        fontSize: 15,
                        shadow: true,
                        shadowAlpha: 0.2,
                        shadowBlur: 5,
                        shadowDistance: 4,
                    },
                    scaleLabel: {
                        backgroundColor: '#424242',
                        padding: 5
                    }
                },
                scaleY: {
                    guide: {
                        visible: false
                    },
                },
                tooltip: {
                    visible: false
                },
                //real-time feed
                refresh: {
                    type: 'feed',
                    transport: 'js',
                    url: 'realTimeFeed()',
                    interval: 200,
                    maxTicks: 10,
                    adjustScale: true,
                    resetTimeout: 500,
                },
                plot: {

                    lineWidth: 3,
                    hoverState: {
                        visible: false
                    },
                    marker: {
                        visible: false
                    },
                    aspect: 'spline'
                },
                series: [{
                    values: [],
                    lineColor: '#39FF14',
                }]
            };
 
            // render chart with width and height to
            // fill the parent container CSS dimensions
            zingchart.render({
                id: 'myChart',
                data: myConfig,
                height: '100%',
                width: '100%',
            });
        });


</script>
</body>
</html>
