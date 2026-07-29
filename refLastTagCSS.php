<style>
body,
div {
  margin: 0;
  border: 0 none;
  padding: 0;
}


html,
body{
  height: 99%;
  min-height: 99%;
}

#wrapper,
#left,
#right {
  height: 98%;
  min-height: 98%;
}

#wrapper {
  width: 100%;
  min-width: 100%;
}

#left {
  width: 64%;
  min-width: 64%;
  background-color: white;
  float: left;
  margin: 1% 0% 0% 1%;
 
}

#right {
    border-radius: 15px 50px;
    background: #d7f3ff;
    width: 34%;
    min-width: 34%;
    margin: 1% 1% 1% 0%;
    float: right;
    padding: 0px 0px 0px 0px;
}

#wrapper {
  margin: 0 auto;
  overflow: hidden;
  width: 100%;
}

div.polaroid {
  
  width:37.5%; 
  height:58%;
  background-color: white;
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
  margin: 0% 0% 1% 7.5%;
  
}

div.polaroid2 {
  
  width:100%; 
  height: 70%;
  background-color: white;
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
  margin: 0% 0% 0% 0%;
}

 

</style>
 
 
<style>

#load{
    width:100%;
    height:100%;
    position:fixed;
    z-index:9999;
    background:url("img/send_msg.gif") no-repeat center center rgba(0,0,0,0.25)
}
</style>


<style> 
 
#rcorners3 {
    border-radius: 15px 50px;
    background-color: #cbf0ff;
    padding: 12px; 
    width: 100%;
    height: 27%;
    padding-left: 5%;
    margin-bottom: 3%;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    /* border: solid 3px #008aff; */
    
} 

#rcorners4 {
    border-radius: 15px 50px;
    background-color: #008aff; 
    padding: 12px; 
    width: 98%;
    height: 20%;
    /* padding-left: 10%; */
    margin-bottom: 3%;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    color: whitesmoke;
} 


#rcorners5 {
    position: fixed;
    left: 2%;
    bottom: 0%;
    border-radius: 15px 50px;
    background-color: #008aff; 
    padding: 12px; 
    width: 62%;
    height: 8%;
    /* padding-left: 10%; */
    margin-bottom: 2.5%;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    color: whitesmoke;
} 
 
</style>
 
    <style>
     
    #snackbar {
        visibility: hidden;
        min-width: 250px;
        margin-left: -125px;
        background-color: #fe5484;
        color: #fff;
        text-align: center;
        border-radius: 2px;
        padding: 16px;
        position: fixed;
        z-index: 1;
        left: 50%;
        bottom: 30px;
        font-size: 17px;
    }
    
    #snackbar.show {
        visibility: visible;
        -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
        animation: fadein 0.5s, fadeout 0.5s 2.5s;
        background-color: #fe5484;
    }


    #snackbar2 {
        visibility: hidden;
        min-width: 250px;
        margin-left: -125px;
        background-color: #fe5484;
        color: #fff;
        text-align: center;
        border-radius: 2px;
        padding: 16px;
        position: fixed;
        z-index: 1;
        left: 50%;
        bottom: 30px;
        font-size: 17px;
    }
    
    #snackbar2.show2 {
        visibility: visible;
        -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
        animation: fadein 0.5s, fadeout 0.5s 2.5s;
        background-color: #fe5484;
    }
    


    #snackbar4 {
        visibility: hidden;
        min-width: 250px;
        margin-left: -125px;
        background-color: #fe5484;
        color: #fff;
        text-align: center;
        border-radius: 2px;
        padding: 16px;
        position: fixed;
        z-index: 1;
        left: 50%;
        bottom: 30px;
        font-size: 17px;
    }
    
    #snackbar4.show4 {
        visibility: visible;
        -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
        animation: fadein 0.5s, fadeout 0.5s 2.5s;
        background-color: #fe5484;
    }
    
    
    #snackbar5 {
        visibility: hidden;
        min-width: 250px;
        margin-left: -125px;
        background-color: #fe5484;
        color: #fff;
        text-align: center;
        border-radius: 2px;
        padding: 16px;
        position: fixed;
        z-index: 1;
        left: 50%;
        bottom: 30px;
        font-size: 17px;
    }
    
    #snackbar5.show5 {
        visibility: visible;
        -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
        animation: fadein 0.5s, fadeout 0.5s 2.5s;
        background-color: #fe5484;
    }
    
    
    #snackbar7 {
        visibility: hidden;
        min-width: 250px;
        margin-left: -125px;
        background-color: #fe5484;
        color: #fff;
        text-align: center;
        border-radius: 2px;
        padding: 16px;
        position: fixed;
        z-index: 1;
        left: 50%;
        bottom: 30px;
        font-size: 17px;
    }
    
    #snackbar7.show7 {
        visibility: visible;
        -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
        animation: fadein 0.5s, fadeout 0.5s 2.5s;
        background-color: #fe5484;
    }
    
    
    #snackbar6 {
        visibility: hidden;
        min-width: 250px;
        margin-left: -125px;
        background-color: #06a90e;
        color: #fff;
        text-align: center;
        border-radius: 2px;
        padding: 16px;
        position: fixed;
        z-index: 1;
        left: 50%;
        bottom: 30px;
        font-size: 17px;
    }
    
    #snackbar6.show6 {
        visibility: visible;
        -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
        animation: fadein 0.5s, fadeout 0.5s 5.0s;
        background-color: #06a90e;
    }
    
    @-webkit-keyframes fadein {
        from {bottom: 0; opacity: 0;} 
        to {bottom: 30px; opacity: 1;}
    }
    
    @keyframes fadein {
        from {bottom: 0; opacity: 0;}
        to {bottom: 30px; opacity: 1;}
    }
    
    @-webkit-keyframes fadeout {
        from {bottom: 30px; opacity: 1;} 
        to {bottom: 0; opacity: 0;}
    }
    
    @keyframes fadeout {
        from {bottom: 30px; opacity: 1;}
        to {bottom: 0; opacity: 0;}
    }
     
    </style>