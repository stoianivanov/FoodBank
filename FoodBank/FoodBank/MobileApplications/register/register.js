var PAGE_MARGIN = 16;
var service = "../../js/event/person.js";
						var entities = [{"name":"id","key":true,"visible":true,"type":"INTEGER","size":10,"widgetType":"text","label":"ID"}, {"name":"name","key":false,"visible":true,"type":"VARCHAR","size":255,"widgetType":"text","label":"Your name"}, {"name":"age","key":false,"visible":true,"type":"INTEGER","size":10,"widgetType":"text","label":"Your age"}];

function makeRequest(url, method, callback, body){
	var request = new tabris.XMLHttpRequest();
	request.onreadystatechange = function(){
		if(request.readyState === request.DONE){
			callback(JSON.parse(request.responseText));
		}
	}
	request.open(method, url);
	if(body !== null){
		request.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
		request.send(JSON.stringify(body));
	}else{
		request.send();
	}
};

var page = new tabris.Page({
  title: "Register for event",
  topLevel: true
});

var scrollView = new tabris.ScrollView({left: 0, top: 0, right: 0, bottom: 0});
for(var i = 0; i<entities.length; i++){
  if(entities[i].visible === true && entities[i].key !== true){
    new tabris.TextView({
      id:"inputLabel"+i,
      text: entities[i].label,
      layoutData: {left: 20, top : ["#inputLabel"+(i-1), 28]}
    }).appendTo(scrollView);
    new tabris.TextInput({
      id: "input"+i,
      layoutData: {left: ["#inputLabel"+i, 50], top : ["#input"+(i-1), PAGE_MARGIN]},
      centerX: 40,
      width: 200
    }).on("input", function(widget, text, options){
      var shouldEnabled = true;
      for(var i = 0; i<entities.length; i++){
        var txt = page.find("#input"+i).get("text"); 
        if(typeof txt !== 'undefined'){
          if(txt === ''){
            console.log(txt);
            shouldEnabled = false;
       		successMessage.set("visible", false);
          }
        }
      }
      saveBtn.set("enabled", shouldEnabled);
    }).appendTo(scrollView);
  }
}

var saveBtn = new tabris.Button({
  id: "saveBtn",
  text: "Save",
  textColor: "white",
  background: "green",
  layoutData : {top:["#input"+(entities.length - 1), PAGE_MARGIN]},
  width: 240,
  centerX: 0,
  enabled: false
}).on("select", function(){
  var entity = {};
  for(var i = 0; i<entities.length; i++){
    if(entities[i].visible === true){
      entity[entities[i].name] = page.find("#input"+i).get("text");
   }	
  }
  makeRequest(service, "POST", function(){
  	successMessage.set("visible", true);
  }, entity);
}).appendTo(scrollView);

var successMessage = new tabris.TextView({
  text: "Successfully created record",
  layoutData: {top: ["#saveBtn", 20]},
  centerX: 0,
  textColor: "green",
  visible: false
}).appendTo(scrollView);

scrollView.appendTo(page);
page.open();
