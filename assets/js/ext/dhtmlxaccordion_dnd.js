//v.3.6 build 130417

/*
Copyright DHTMLX LTD. http://www.dhtmlx.com
To use this component please contact sales@dhtmlx.com to obtain license
*/
dhtmlXAccordion.prototype.enableDND=function(){for(var e=0;e<this.base.childNodes.length;e++)this.base.childNodes[e].firstChild._click=this.base.childNodes[e].firstChild.onclick,this.base.childNodes[e].firstChild.onclick=function(){i.dragMOffset||this._click()};var h=this,i=dhtmlXAccordionDND(this.base);i.doOnDragStop=function(){h.setSizes();h.callEvent("onDrop",arguments)}};
function dhtmlXAccordionDND(e){for(var h=this,i=0;i<e.childNodes.length;i++)e.childNodes[i].onmousedown=function(d){var d=d||event,c=d.target||d.srcElement;if(c==this.firstChild||c==this.firstChild.firstChild)h.dragStart(d||event,this)};this.dragStart=function(d,c){this.dragObj=c;this.dragObj.className+=" dragged";this.dy=d.clientY;this.h=this.dragObj.offsetHeight;for(var a=0,f=0;f<this.dragObj.parentNode.childNodes.length;f++)this.dragObj.parentNode.childNodes[f]._ind=f,this.dragObj.parentNode.childNodes[f]==
this.dragObj?(this.dragObj._k0=a,a=0):a+=this.dragObj.parentNode.childNodes[f].offsetHeight;this.dragObj._k1=a+2;this.dragMOffset=!1};this.doDrag=function(d){if(this.dragObj){var c=d.clientY-this.dy;if(Math.abs(c)>5)this.dragMOffset=!0;if(c<0)c<-this.dragObj._k0&&(c=-this.dragObj._k0);else if(c>this.dragObj._k1)c=this.dragObj._k1;this.dragObj.style.top=c+"px";for(var a=d.clientY-this.dy,f=0,j=0,g=this.dragObj._ind+1;g<=this.dragObj.parentNode.lastChild._ind;g++){var e=this.dragObj.parentNode.childNodes[g].offsetHeight;
a>f+e*2/3&&j++;f+=e}for(var b=this.dragObj.nextSibling,g=0;b!=null;){if(++g<=j&&b!=null){if(!b._ontop)b._tm&&window.clearTimeout(b._tm),this.animate(b,!1,parseInt(b.style.top||0),-this.h),b._ontop=!0}else if(b._ontop)b._tm&&window.clearTimeout(b._tm),this.animate(b,!0,parseInt(b.style.top||0),0),b._ontop=!1;b=b.nextSibling}a=this.dy-d.clientY;j=f=0;for(g=this.dragObj._ind-1;g>=this.dragObj.parentNode.firstChild._ind;g--)e=this.dragObj.parentNode.childNodes[g].offsetHeight,a>f+e*2/3&&j++,f+=e;b=this.dragObj.previousSibling;
for(g=0;b!=null;){if(++g<=j&&b!=null){if(!b._onbottom)b._tm&&window.clearTimeout(b._tm),this.animate(b,!0,parseInt(b.style.top||0),this.h),b._onbottom=!0}else if(b._onbottom)b._tm&&window.clearTimeout(b._tm),this.animate(b,!1,parseInt(b.style.top),0),b._onbottom=!1;b=b.previousSibling}}};this.dragStop=function(){if(this.dragObj){this.dragObj.className=String(this.dragObj.className).replace(/dragged/gi,"");this.dragObj.style.top="0px";for(var d=!1,c=0;c<this.dragObj.parentNode.childNodes.length;c++){var a=
this.dragObj.parentNode.childNodes[c];if(a!=this.dragObj){a._tm&&window.clearTimeout(a._tm);a.style.top="0px";if(a._ontop&&(a.nextSibling!=null&&a.nextSibling._ontop!=!0||!a.nextSibling))d=a.nextSibling||null;if(a._onbottom&&(a.previousSibling!=null&&a.previousSibling._onbottom!=!0||!a.previousSibling))d=a}a=null}for(c=0;c<this.dragObj.parentNode.childNodes.length;c++)this.dragObj.parentNode.childNodes[c]._ontop=null,this.dragObj.parentNode.childNodes[c]._onbottom=null;d!==!1&&(d==null?this.dragObj.parentNode.appendChild(this.dragObj):
this.dragObj.parentNode.insertBefore(this.dragObj,d));if(typeof this.doOnDragStop!="undefined")for(var f=this.dragObj._id,e=this.dragObj._ind,g=e,c=0;c<this.dragObj.parentNode.childNodes.length;c++)this.dragObj.parentNode.childNodes[c]==this.dragObj&&(g=c);this.dragObj=null;typeof this.doOnDragStop!="undefined"&&e!=g&&this.doOnDragStop(f,e,g)}};this.animate=function(d,c,a,f){var e=!1;c?(a+=5,a>=f&&(a=f,e=!0)):(a-=5,a<=f&&(a=f,e=!0));d.style.top=a+"px";d._tm&&window.clearTimeout(d._tm);d._tm=e?null:
window.setTimeout(function(){h.animate(d,c,a,f)},5)};this.doOnMouseMove=function(d){h.doDrag(d||event)};this.doOnMouseUp=function(d){h.dragStop(d||event)};window.addEventListener?(document.body.addEventListener("mousemove",this.doOnMouseMove,!1),document.body.addEventListener("mouseup",this.doOnMouseUp,!1)):(document.body.attachEvent("onmousemove",this.doOnMouseMove,!1),document.body.attachEvent("onmouseup",this.doOnMouseUp,!1));return this};

//v.3.6 build 130417

/*
Copyright DHTMLX LTD. http://www.dhtmlx.com
To use this component please contact sales@dhtmlx.com to obtain license
*/