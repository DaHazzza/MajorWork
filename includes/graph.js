
export default function lineGraph(data, canvas){

    //initalising variables and pulling data from the data dict
    var ctx = canvas.getContext('2d');
    var canvWidth = canvas.width;
    var canvHeight = canvas.height;
    var borderX = data['border'][0]
    var borderY = data['border'][1]
    var width =canvWidth-(2*borderX)
    var height =canvHeight-(2*borderY)
    var popUp = []
    var lables = data['lables']
    var yLable = data['yLable']
    
    //draw bounding box
   //ctx.moveTo(borderX,borderY)
   //ctx.lineTo(borderX, canvHeight-borderY)
   //ctx.lineTo(canvWidth-borderX, canvHeight-borderY)
   //ctx.lineTo(canvWidth-borderX, borderY)
   //ctx.lineTo(borderX, borderY)

    //create yaxis lable
    ctx.font = '15px Arial';
    ctx.save();
    ctx.translate(borderX/2,canvHeight/2);
    ctx.rotate(-0.5*Math.PI);
    ctx.fillText(yLable , 0, 0);
    ctx.restore();
    var yAxis = data['yAxis'];
    
    // does this to deal with scaling so can be used with any sized canvas
    var maxY = Math.max.apply(Math,yAxis);

    var xMultiplyer = Math.round((width)/(yAxis.length-1));
    var yMultiplyer = Math.round((height)/maxY);

    for(var i = 0; i < yAxis.length; ++i){ //for each value

        //draw lines between
        var newX = (i*xMultiplyer)+borderX
        var newY = (height-(yAxis[i]*yMultiplyer))+borderY
        ctx.moveTo(newX, newY );
        ctx.lineTo(((i+1)*xMultiplyer)+borderX,(height-( yAxis[i+1]*yMultiplyer))+borderY);
        ctx.stroke();     

        //draw black dots
        ctx.beginPath();
        ctx.arc(newX, newY , 5, 0, 2 * Math.PI);
        ctx.fill();

        //add the point to an array so it can be used to detect when the mouse is over it
        popUp.push([newX, newY,yAxis[i]])
       
        //bottom text
        ctx.font = "10px Arial";
        ctx.textAlign = "center";
        ctx.fillText(lables[i],(newX),canvHeight-(borderY/2))
    }

    //where the value will appear
    var x = (canvWidth/2)+20
    var y=(borderY/2)+10

    //when mouse moves
    canvas.addEventListener("mousemove", function(e) { 

        //get mouse pos
        var cRect = canvas.getBoundingClientRect();     
        var canvasX = Math.round(e.clientX - cRect.left) ;
        var canvasY = Math.round(e.clientY - cRect.top);

        //for each point check if mouse is near, if so draw the lable of the value of that point else clear
        var printed = false
        popUp.forEach(i => {
            if(canvasX > i[0]-30 && canvasX < i[0]+30  && canvasY > i[1]-30 && canvasY < i[1]+30  ){
                ctx.font = "20px Arial";
                ctx.fillText(i[2],x,y)
                printed = true
            } else if (printed == false) {
                ctx.clearRect(x-20,y-17,40,20)                
            }
        })
        
    
    });


}   

