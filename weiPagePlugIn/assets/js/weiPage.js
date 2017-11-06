(function(){

	var weiPage = function(){	
			
	};
	
	var plugInIndex = 1000;			//插件序号，该字段在导航模块会使用	
	var plugInUuid = 0;					//插件通用唯一标识，方便快速查找使用，该字段最后导出的时候会被过滤掉
	
	var plugInSelector = weiPageConfig.engineConfig.plugIn;										//通过引擎配置读取插件配置选择器名称
	var subPlugInSelector = weiPageConfig.engineConfig.subPlugIn;							//通过引擎配置读取子插件配置选择器名称
	
	//创建微页面
	weiPage.prototype.createWeipage = function(data){
		var initData;
		if(data){
			initData = data;
		}else{
			initData = weiPageConfig.plugInConfig.main.data;											//从配置文件读取初始化数据
		}
		
		this.setInitData(initData);
	};	
	
	//编辑微页面
	weiPage.prototype.editWeipage = function(obj){
		this.$().attr(obj);
	};
	
	//获取微页面
	weiPage.prototype.getWeipage = function(){
		return this.$().val();
	};	
	
	//创建插件唯一标识id
	weiPage.prototype.createUuid = function(plugInData){
		if(plugInData && typeof plugInData == "object"){
			plugInUuid++;		
			var resultData = {};
			for(var key in plugInData){
				resultData[key] = plugInData[key];
			}
			resultData["plugInUuid"] = plugInUuid;
			return resultData;
		}		
	};
	
	//创建插件id（该方法用于给返回的插件id给导航插件使用，插件id最终会导出，而plugInUuid最终导出会被当做临时使用字段滤除掉）
	weiPage.prototype.createPlugInId = function(plugInData){
		var plugInIdName = weiPageConfig.specialConfig.plugInId;								//通过特殊配置获取插件id的名称
		var plugInIdTab = weiPageConfig.specialConfig.plugInIdTab;							//通过特俗配置获取插件id标识
		
		plugInIndex ++;
		var resultData = {};
		
		for(var key in plugInData){
			resultData[key] = plugInData[key];		
		}
		
		resultData[plugInIdName] = plugInIdTab + plugInIndex;
		
		return resultData;
	};
	
	//创建插件
	weiPage.prototype.createPlugIn = function(plugIntype){
		if(!plugIntype){
			return;
		}
		
		var plugIn = weiPageConfig.mapperConfig.plugIn[plugIntype];							//通过映射配置读取插件名称
		var plugInInitData = JSON.parse(JSON.stringify(weiPageConfig.plugInConfig[plugIn].data.plugIn));				//通过插件配置读取插件数据
		
		plugInInitData = this.createPlugInId(plugInInitData);				
		var plugInData = this.createUuid(plugInInitData);
		
		var resultList = this.$(plugInSelector).add(plugInData);
		
		return resultList.find({plugInUuid:plugInData.plugInUuid});
	};
	
	//选中插件
	weiPage.prototype.selectPlugIn = function(selectParam){	
		this.$(plugInSelector).find(selectParam).attr({plugInSelect:true});
	};
	
	//让所有插件失去选中
	weiPage.prototype.unSelectPlugIn = function(){
		this.$().attr({plugInSelect:false},true);																	//深度操作让所有plugInSelect都变成false
	};
	
	//删除插件
	weiPage.prototype.removePlugIn = function(selectParam){
		this.$(plugInSelector).remove(selectParam);
	};
	
	//编辑选中插件
	weiPage.prototype.editSelectPlugIn = function(parameter,isdeep){
		this.$(plugInSelector).find({plugInSelect:true}).attr(parameter,isdeep);
	};
	
	//获取插件列表
	weiPage.prototype.getPlugInList = function(){
		return this.$(plugInSelector);
	};
	
	//获取选中插件
	weiPage.prototype.getSelectPlugIn = function(){
		return this.$(plugInSelector).find({plugInSelect:true});
	};
	
	//判断选中插件是否有子插件
	weiPage.prototype.selectHasSubPlugIn = function(){
		var selectPlugIn = this.$(plugInSelector).find({plugInSelect:true});
		if(selectPlugIn && selectPlugIn.attr("subPlugInList") && selectPlugIn.attr("subPlugInList").length > 0){
			return true;
		}else{
			return false;
		}
	};
	
	//创建子插件
	weiPage.prototype.createSubPlugIn = function(param){
		var plugInData = this.$(plugInSelector).find({plugInSelect:true});		
				
		var subPlugInInitData;		
		if(param){
			subPlugInInitData = param;
		}else{
			var plugIntype = plugInData.attr("plugIntype");
			var plugIn = weiPageConfig.mapperConfig.plugIn[plugIntype];																			//通过映射配置读取插件名称
			subPlugInInitData = JSON.parse(JSON.stringify(weiPageConfig.plugInConfig[plugIn].data.subPlugIn));		//通过插件配置读取插件数据
		}
		
		var subPlugInData = this.createUuid(subPlugInInitData);		
		var resultList = plugInData.find(subPlugInSelector).add(subPlugInData);
		
		return resultList.find({plugInUuid:subPlugInData.plugInUuid});			
	};
	
	//选中子插件
	weiPage.prototype.selectSubPlugIn = function(selectParam){
		this.$(plugInSelector).find({plugInSelect:true}).find(subPlugInSelector).find(selectParam).attr({plugInSelect:true});
	};
	
	//让选中的插件的所有子插件失去选中
	weiPage.prototype.unSelectSubPlugIn = function(){
		var subPlugIn = this.$(plugInSelector).find({plugInSelect:true}).find(subPlugInSelector);
		for(var i = 0; i < subPlugIn.data.length; i++){
			subPlugIn.find(i).attr({plugInSelect:false},true);			//深度操作让所有plugInSelect都变成false
		}
	};
	
	//移除子插件
	weiPage.prototype.removeSubPlugIn = function(selectParam){
		this.$(plugInSelector).find({plugInSelect:true}).find(subPlugInSelector).remove(selectParam);
	};
	
	//编辑选中子插件
	weiPage.prototype.editSelectSubPlugIn = function(parameter){
		this.$(plugInSelector).find({plugInSelect:true}).find(subPlugInSelector).find({plugInSelect:true}).attr(parameter);
	};
	
	//获取子插件列表
	weiPage.prototype.getSubPlugInList = function(){
		return this.$(plugInSelector).find({plugInSelect:true}).find(subPlugInSelector);
	};
	
	//获取选中子插件
	weiPage.prototype.getSelectSubPlugIn = function(){
		return this.$(plugInSelector).find({plugInSelect:true}).find(subPlugInSelector).find({plugInSelect:true});
	};
	
	//初始化微页面
	weiPage.prototype.initWeipage = function(initData){
		//先创建uuid再进行初始化
		if(initData){
			if(initData[plugInSelector] && $.isArray(initData[plugInSelector])){
				for(var i = 0; i < initData[plugInSelector].length; i++){
					initData[plugInSelector][i] = this.createUuid(initData[plugInSelector][i]);
					if(initData[plugInSelector][i][subPlugInSelector] && $.isArray(initData[plugInSelector][i][subPlugInSelector])){
						for(var j = 0; j < initData[plugInSelector][i][subPlugInSelector].length;j++){
							initData[plugInSelector][i][subPlugInSelector][j] = this.createUuid(initData[plugInSelector][i][subPlugInSelector][j]);
						}
					}
				}				
			}
		}
		this.createWeipage(initData);
		
		return this.$();
	};
	
	//导出微页面
	weiPage.prototype.exportWeipage = function(){
		this.setDisableProperty(["plugInUuid","plugInSelect"]);										//滤除掉微页面使用的临时字段
		return this.exportData();
	};
	
	//继承工厂(前继承后)
	function inheritFactory(weiPagePlugin,dataEnginePlugin){
		weiPage.prototype = dataEnginePlugin;
		for(var key in weiPagePlugin){
			weiPage.prototype[key] = weiPagePlugin[key];
		}	
		return new weiPage();
	}
	
	window.WeiPage = function(){
		var weiPagePlugin = new weiPage();		
		var dataEnginePlugin = window.DataEngine();
		
		var resultPlugin = inheritFactory(weiPagePlugin,dataEnginePlugin);
		
		return resultPlugin;
	};
	
})();

