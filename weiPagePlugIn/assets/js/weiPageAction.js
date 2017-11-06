var weiPage = WeiPage();	

//插件视图标识（插件redraw的时候会通过该标识+plugInUuid查找div的id找到要替换的块）
var plugInIdViewTab = weiPageConfig.specialConfig.plugInIdViewTab;

//微页面视图
var weiPageView = {
		//重绘已选中的模块
		redrawSelect:{
			//插件
			plugIn:function(){
				var plugInData = weiPage.getSelectPlugIn().val();
				weiPageView.redrawPlugIn(plugInData);
			},
			//插件编辑模块
			plugInEdit:function(){
				var plugInData = weiPage.getSelectPlugIn().val();
				weiPageView.redrawPlugInEdit(plugInData);
			},
			//子插件
			subPlugIn:function(){
				var plugInData = weiPage.getSelectPlugIn().val();
				var subPlugInData = weiPage.getSelectSubPlugIn().val();
				weiPageView.redrawSubPlugIn(subPlugInData,plugInData["plugIntype"],plugInData["showType"]);
			},
			//子插件编辑模块
			subPlugInEdit:function(){
				//判断是否有配置子插件模板
				var plugIntype = weiPage.getSelectPlugIn().attr("plugIntype");
				var plugInName = weiPageConfig.mapperConfig.plugIn[plugIntype];								//通过映射配置读取插件名称			
				if(weiPageConfig.plugInConfig[plugInName].template.edit["subPlugIn"]){
					var plugInData = weiPage.getSelectPlugIn().val();
					var subPlugInData = weiPage.getSelectSubPlugIn().val();
					weiPageView.redrawSubPlugInEdit(subPlugInData,plugInData["plugIntype"]);
				}else{
					weiPageView.redrawSubPlugInEdit();
				}			
			}
		},
		
		//移除模块
		removeView:function(plugInUuid){
			var tempIdSelector = "#" + plugInIdViewTab + plugInUuid;
			$(tempIdSelector).remove();
		},
		
		//重绘整个微页面视图
		redrawView:function(){
			var dataList = weiPage.getPlugInList().val();
			if(dataList && $.isArray(dataList)){
				var plugInHtm = "";
				for(var i = 0; i < dataList.length; i++){
					var data = dataList[i];
					var plugInName = weiPageConfig.mapperConfig.plugIn[data["plugIntype"]];											//通过映射配置读取插件名称						
					var templateId = weiPageConfig.plugInConfig[plugInName].template.view.plugIn[data["showType"]];	//通过插件配置读取模板id		
					var tempHTML = template(templateId,data);
					plugInHtm  += weiPageView.installPlugIn(tempHTML,data);					
				}
				$("#mobilePage").html(plugInHtm);
			}
		},		
		//重绘插件
		redrawPlugIn:function(data){
			if(data){
				var tempIdSelector = "#" + plugInIdViewTab + data["plugInUuid"];			
				var plugInName = weiPageConfig.mapperConfig.plugIn[data["plugIntype"]];											//通过映射配置读取插件名称						
				var templateId = weiPageConfig.plugInConfig[plugInName].template.view.plugIn[data["showType"]];	//通过插件配置读取模板id		
				var tempHTML = template(templateId,data);			
				var plugInHtm  = weiPageView.installPlugIn(tempHTML,data);
				
				$(tempIdSelector).replaceWith(plugInHtm);
			}			
		},
		//重绘插件编辑模块
		redrawPlugInEdit:function(data){
			if(data){
				var plugInName = weiPageConfig.mapperConfig.plugIn[data["plugIntype"]];											//通过映射配置读取插件名称
				if(!plugInName){
					plugInName = "main";
				}
				var templateId = weiPageConfig.plugInConfig[plugInName].template.edit.plugIn;									//通过插件配置读取模板id
				var tempHtml = template(templateId,data);
				
				$("#plugIn_option_form").html(tempHtml);
			}else{
				$("#plugIn_option_form").html("");
			}
		},
		//重绘子插件
		redrawSubPlugIn:function(data,plugIntype,showType){
			if(data && plugIntype != undefined && showType != undefined){
				var tempIdSelector = "#" + plugInIdViewTab + data["plugInUuid"];			
				var plugInName = weiPageConfig.mapperConfig.plugIn[plugIntype];															//通过映射配置读取插件名称						
				var templateId = weiPageConfig.plugInConfig[plugInName].template.view.subPlugIn[showType];				//通过插件配置读取模板id		
				var tempHTML = template(templateId,data);
				
				$(tempIdSelector).replaceWith(tempHTML);
			}			
		},
		//重绘子插件编辑模块
		redrawSubPlugInEdit:function(data,plugIntype){
			if(data && plugIntype){
				var plugInName = weiPageConfig.mapperConfig.plugIn[plugIntype];														//通过映射配置读取插件名称						
				var templateId = weiPageConfig.plugInConfig[plugInName].template.edit.subPlugIn;							//通过插件配置读取模板id
				var tempHtml = template(templateId,data);
				
				$("#subPlugIn_option_form").html(tempHtml);
			}else{
				$("#subPlugIn_option_form").html("");
			}
		},
		
		//组装插件
		installPlugIn:function(plugInHtml,data){
			var plugInData = {
					plugInUuid : data["plugInUuid"],
					plugInSelect : data["plugInSelect"],
					backgroundColor : data["backgroundColor"],
					showbgPicUrl : data["showbgPicUrl"],
					plugInHtml : plugInHtml
			}
			return template("plugIn_common_page",plugInData);
		},
};

//微页面响应事件
var weiPageAction = {
		//初始化
		initWeipage:function(initData){
			weiPage.initWeipage(initData);
				
			weiPageAction.selectWeipage();
			if(initData && initData.title){
				$(".yui_mobile_head h1").html(initData.title);
			}
		},		
		//选中微页面
		selectWeipage:function(){
			var weiPageData = weiPage.getWeipage();
			
			weiPage.unSelectPlugIn();
			weiPageView.redrawView();						
			weiPageView.redrawPlugInEdit(weiPageData);
			weiPageView.redrawSubPlugInEdit();
			$("#edit_RTE_wrap").css("display","none");
		},
		//编辑微页面
		editWeipage:function(name,value){
			var obj = {};
			obj[name] = value;
			weiPage.editWeipage(obj);
			if(name == "title"){
				$(".yui_mobile_head h1").html(value);
			}
			var weiPageData = weiPage.getWeipage();
			weiPageView.redrawPlugInEdit(weiPageData);
		},
		//选中插件
		selectPlugIn:function(plugInUuid){
			weiPage.unSelectPlugIn();
			weiPage.selectPlugIn({plugInUuid:plugInUuid});
			
			//如果拥有子插件默认选中第一个子插件
			if(weiPage.selectHasSubPlugIn()){
				weiPageAction.selectSubPlugIn(0);
			}else{
				weiPageView.redrawSubPlugInEdit();
			}
					
			weiPageView.redrawView();
			weiPageView.redrawSelect.plugInEdit();			
			
			//富文本打开富文本编辑器
			if(weiPage.getSelectPlugIn().attr("plugIntype") == 1 ){
				$("#edit_RTE_wrap").css("display","block");
			}else{
				$("#edit_RTE_wrap").css("display","none");
			}
		},
		//选中子插件
		selectSubPlugIn:function(param){
			weiPage.unSelectSubPlugIn();
			weiPage.selectSubPlugIn(param);
			
			weiPageView.redrawSelect.plugIn();		
			weiPageView.redrawSelect.subPlugInEdit();
		},
		//编辑选中插件
		editSelectPlugIn:function(name,value,isdeep){
			var param = {};
			param[name] = value;
			weiPage.editSelectPlugIn(param,isdeep);
			
			weiPageView.redrawSelect.plugIn();	
		},		
		//编辑选中子插件
		editSelectSubPlugIn:function(name,value){
			var param = {};
			param[name] = value;
			weiPage.editSelectSubPlugIn(param);
			
			weiPageView.redrawSelect.subPlugIn();	
		},
		//删除子插件
		removeSubPlugIn:function(plugInUuid){
			weiPage.removeSubPlugIn({plugInUuid:plugInUuid});
			
			var subPlugInList = weiPage.getSubPlugInList().val();
			var subPlugInLength = subPlugInList.length;
			if(subPlugInLength > 0){
				var lastPlugInUuid = subPlugInList[subPlugInLength - 1]["plugInUuid"];
				weiPageAction.selectSubPlugIn({plugInUuid:lastPlugInUuid});				
			}else{
				var parentUuid = weiPage.getSelectPlugIn().attr("plugInUuid");
				weiPageAction.selectPlugIn(parentUuid);
			}
		}
}

//微页面事件
var weiPageEvent = {		
		//创建插件
		createPlugIn:function(e){
			var plugIntype = $(this).attr("data-plugIntype");
			var plugInData = weiPage.createPlugIn(plugIntype);
			weiPageAction.selectPlugIn(plugInData.attr("plugInUuid"));
			
			var plugInName = weiPageConfig.mapperConfig.plugIn[plugIntype];								//通过映射配置读取插件名称
			var plugInInitData = weiPageConfig.plugInConfig[plugInName].initData;						//通过插件初始化数据			
			//判断是否需要初始化生成固定量的子插件
			if(plugInInitData["subPlugInNum"]){
				for(var i = 0; i < plugInInitData.subPlugInNum;i++){
					weiPage.createSubPlugIn();
				}
				weiPageAction.selectSubPlugIn(0);		//选中第一个子插件							
			}else{
				weiPageView.redrawSelect.subPlugInEdit();
			}
			
			weiPageView.redrawView();
			weiPageView.redrawSelect.plugInEdit();
			
			e.stopPropagation();
		},
		//选中插件
		selectPlugIn:function(e){
			var plugInUuid = $(this).attr("data-plugInUuid");
			weiPageAction.selectPlugIn(plugInUuid);
			
			e.stopPropagation();
		},
		//删除插件
		removePlugIn:function(e){
			var plugInUuid = $(this).attr("data-plugInUuid");
			weiPage.removePlugIn({plugInUuid:plugInUuid});
			
			var plugInList = weiPage.getPlugInList().val();
			var plugInLength = plugInList.length;
			if(plugInLength > 0){
				var lastPlugInUuid = plugInList[plugInLength - 1]["plugInUuid"];		
				weiPageAction.selectPlugIn(lastPlugInUuid);
			}else{
				weiPageAction.selectWeipage();	
			}	
			
			e.stopPropagation();
		},
		//创建子插件
		createSubPlugIn:function(e){
			var plugInData = weiPage.createSubPlugIn();
			weiPageAction.selectSubPlugIn({plugInUuid:plugInData.attr("plugInUuid")});	
			weiPageView.redrawSelect.plugInEdit();
			
			e.stopPropagation();
		},
		//选中子插件
		selectSubPlugIn:function(e){
			var plugIn = $(this).closest(".plugIn_wrap");
			if(plugIn && plugIn.hasClass("current")){
				var plugInUuid = $(this).attr("data-plugInUuid");
				weiPageAction.selectSubPlugIn({plugInUuid:plugInUuid});	
				
				e.stopPropagation();
			}				
		},
		//删除子插件
		removeSubPlugIn:function(e){
			var plugInUuid = $(this).attr("data-plugInUuid");			
			weiPageAction.removeSubPlugIn(plugInUuid);
			
			e.stopPropagation();
		}		
};

	//选中微页面
	$(".yui_mobile_head").click(weiPageAction.selectWeipage);
	//创建插件
	$(".weipage_nav_list li").click(weiPageEvent.createPlugIn);
	//创建子插件
	$("#subPlugIn_option_form").on("click",".addPlugIn",weiPageEvent.createSubPlugIn);
	//选中插件
	$("#mobilePage").on("click",".plugIn_wrap",weiPageEvent.selectPlugIn);
	//选中子插件
	$("#mobilePage").on("click",".subPlugIn_wrap",weiPageEvent.selectSubPlugIn);
	//删除插件
	$("#plugIn_option_form").on("click",".removePlugIn",weiPageEvent.removePlugIn);		
	//删除子插件
	$("#subPlugIn_option_form").on("click",".removePlugIn",weiPageEvent.removeSubPlugIn);	
	//编辑插件
	$("#plugIn_option_form").on("change","input,select",function(){
		var value = $(this).val();
		var name = $(this).attr("name");
		
		if($(this).attr("type") == "file"){
			var tempThis = this;
			uploadImageFactory(tempThis,function(value){
				if(weiPage.getSelectPlugIn().data){				
					weiPageAction.editSelectPlugIn(name,value);
				}else{
					weiPageAction.editWeipage(name,value);
				}
			});
		}else{
			//判断是编辑插件还是变成微页面数据
			if(weiPage.getSelectPlugIn().data){		
				var deep;
				//当为导航按钮背景颜色时或者showType需要深度操作
				if((weiPage.getSelectPlugIn().attr("plugIntype") == "2" && (name == "btnColor" || name == "btnSelectedColor")) || name == "showType"){
					deep = true;
				}
				weiPageAction.editSelectPlugIn(name,value,deep);
			}else{
				weiPageAction.editWeipage(name,value);
			}
			
			//是否需要重绘编辑块
			if($(this).attr("data-redraw-form")){
				weiPageView.redrawSelect.plugInEdit();
				weiPageView.redrawSelect.subPlugInEdit();
			}
		}	
	});
	//编辑子插件
	$("#subPlugIn_option_form").on("change","input,select",function(){
		var value = $(this).val();
		var name = $(this).attr("name");
		var tempThis = this;
		if($(this).attr("type") == "file"){
			uploadImageFactory(this,function(value){
				weiPageAction.editSelectSubPlugIn(name,value);
				weiPageView.redrawSelect.plugInEdit();
				weiPageView.redrawSelect.subPlugInEdit();
			});
		}else{
			weiPageAction.editSelectSubPlugIn(name,value);
			//是否需要重绘编辑块
			if($(this).attr("data-redraw-form")){
				weiPageView.redrawSelect.plugInEdit();
				weiPageView.redrawSelect.subPlugInEdit();
			}
		}				
	});
	//切换子插件
	$("#plugIn_option_form").on("click",".subPlugIn_wrap",function(){
		var plugInUuid = $(this).attr("data-plugInUuid");
		weiPageAction.selectSubPlugIn({plugInUuid:plugInUuid});
		weiPageView.redrawSelect.plugInEdit();
	});
	//在插件操作框中删除子插件
	$("#plugIn_option_form").on("click",".subPlugIn_remove",function(e){
		var plugInUuid = $(this).attr("data-plugInUuid");			
		weiPageAction.removeSubPlugIn(plugInUuid);		
		weiPageView.redrawSelect.plugInEdit();
		
		e.stopPropagation();
	});
	/*		
	 * 以下是一些特殊事件
	 * 
	 */
	//重设颜色
	$("#plugIn_option_form").on("click",".resetBtn",function(){
		var form = $(this).closest(".form_one");
		var value = $(this).attr("data-value");
		$(form).find("[type='color']").val(value);
		var name = $(form).find("[type='color']").attr("name");
		if(weiPage.getSelectPlugIn().data){			
			weiPageAction.editSelectPlugIn(name,value);
		}else{
			weiPageAction.editWeipage(name,value);
		}
	});
	
	
	//图片上传配置
    $("#plugIn_edit_page").on("click",".upload_image",function(){
	    var file = 	$(this).find(".input_image")[0];
	    file.click();
    });
    //上传图片工厂
    function uploadImageFactory(file,callBackFun){
    		var formData = new FormData();
    		formData.append("image", file["files"][0]);
    		$.ajax({
    			url:"/pic/upload",
    			type:"post",
    			data:formData,
    			dataType: "JSON",
    			contentType: false,
            	processData: false,
            	success:function(res){
    				if(res && res.result){
    					callBackFun(res.picUrl);
    				}  				
    			}
    		})
    }
	
	$(function(){
		//富文本编辑器配置
		UE.Editor.prototype._bkGetActionUrl = UE.Editor.prototype.getActionUrl;
	    UE.Editor.prototype.getActionUrl = function(action) {
	                if (action == 'uploadimage' || action == 'uploadscrawl' || action == 'uploadimage') {
	                    return '/uEditor/pic/upload';
	                } else if (action == 'uploadvideo') {
	                    return '/uEditor/pic/upload';
	                } else {
	                    return this._bkGetActionUrl.call(this, action);
	                }
	    };
	    
	    function initEditor () {
	    		var uE = UE.getEditor('edit_RTE');
	    		uE.addListener("contentChange",function(){
	    			var rteText = this.getContent();
	    			weiPageAction.editSelectPlugIn("txtHtml",rteText);
	    		});
	    }
	    initEditor();	    
	});