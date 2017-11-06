(function($){
	//数据引擎
	var dataEngine = function(){
		
		this.view = undefined; 								//引擎显示数据
		
		//无效属性
		//添加到列表中的属性会在exportData时滤除掉
		//无效属性的命名建议特殊化，比如加上一些特俗的前缀，以免跟引擎显示数据的属性名重叠最终导出时被误删
		this.disablePropertyList = [];								
		
	};
	
	dataEngine.prototype.getDisableProperty = function(){
		return this.disablePropertyList;
	};
	
	//设置无效属性
	dataEngine.prototype.setDisableProperty = function(list){
		if($.isArray(list)){
			this.disablePropertyList = list;
		}	
	};

	
	/*		数据搜索引擎
	 *		count 	递归计数器(用于防止死循环，传0参数)
	 * 		searchOption 查找条件参数(可以为object或者array)，格式如下
	 * {
	 * 		key		查找的字段名称（当搜索对象时必选）
	 * 		value 	查找的字段值（当搜索数组时必选）	
	 * 	【当节点为对象时判断key对应字段的值和value相匹配时返回本对象，当节点为数组时返回value对应的下标，当value没有参数时返回的是key查找到的节点】
	 * }
	 * 		例如:
	 * 			var a = {b1:"1",b2:"2",b3:[{c1;"3",c2:"4"},{c1:"5",c2:"6"}]}
	 * 			var x = [{y1:"1",y2:[{z:1:"1",z2:"2"}]},{y1:"11",y2:[{z:1:"11",z2:"21"}]}];
	 * 		【1】searchData(0,{key:"b3"},a)   										返回 b3 即 [{c1;"3",c2:"4"},{c1:"5",c2:"6"}]
	 * 		【2】searchData(0,{key:"b2",value:"2"},a)							返回 a
	 * 		【3】searchData(0,{key:"b3",value:"1"},a)							返回 b3[1] 即{c1:"5",c2:"6"}
	 * 
	 * 		【4】searchData(0,{value:"0"},x)										返回 x[0] 即{y1:"1",y2:[{z:1:"1",z2:"2"}]}
	 * 		【5】searchData(0,{key:"y1",value:"11"},x)							返回x[1] 即 {y1:"11",y2:[{z:1:"11",z2:"21"}
	 * 
	 * 			还支持以上的组合连级查询
	 * 		【1】和【5】searchData(0,[{key:"b3"},{key:"c2",value:"4"}],a)		返回b3[0] 即{c1;"3",c2:"4"}
	 * 
	 * 		sourceData 查找的数据源范围，不传参数为this.view
	 * */
	dataEngine.prototype.searchData = function(count,searchOption,sourceData){		
		if(!searchOption || count > 10000){
			return null;
		}
		
		var result,search,data;
		
		if(sourceData){					
			data = sourceData;
		}else{			
			data = this.view;
		}
		
		if($.isArray(searchOption) && searchOption.length > 0){
			//取出第一个对象
			var searchList = searchOption.splice(0,1);	
			search = searchList[0];
		}else if(typeof searchOption == "object"){
			search = searchOption;
		}else{
			return null;
		}		
		
		if(search.value || search.value == 0){
				var valueNum = Number(search.value);				
				if($.isArray(data)){					
					//搜索范围为数组
					if(search.key){
						for(var i = 0; i < data.length;i++){
							if(data[i].hasOwnProperty(search.key) && data[i][search.key] == search.value){
								//【5】
								result = data[i];
							}
						}
						if(!result){
							console.log("在列表中查找不到"+search.key+":"+search.value+"所在的对象");
						}
					}else{						
						if(!isNaN(valueNum)){
							//【4】
							result = data[valueNum];
						}else{
							console.log("在列表中搜索中，key没有值时value必须是数值");
						}
					}
				}else{
					//搜索范围为对象
					if(search.key){
						if(data.hasOwnProperty(search.key)){							
							if($.isArray(data[search.key])){							
								if(!isNaN(valueNum)){
									if(data[search.key].length > valueNum){
										//【3】
										result = data[search.key][valueNum];
									}else{
										console.log(search.key+"查找结果的数组中找不到下标"+valueNum);
									}
								}else{
									console.log(search.key+"查找结果为一个数组，"+search.value+"必须是数字或者可以转成数字的字符串，才可以返回数组对应下标的对象");
								}
							}else{							
								if(data[search.key] == search.value){
									//【2】
									result = data;
								}else{
									console.log("查找不到"+search.key+":"+search.value+"所在的对象");
								}
							}
						}else{
							console.log("找不到对象"+search.key);
						}
					}else{
						console.log("搜索范围为对象时key不能为空");
					}					
				}				
		}else{				
				if(data.hasOwnProperty(search.key)){										
					//【1】
					result = data[search.key];
				}else{
					console.log("找不到对象"+search.key);
				}
		}	
			
		if(searchOption.length > 0 && result){
			return this.searchData(count++,searchOption,result);
		}else{
			return result;
		}
		
	};
	
	//选择器引擎，查找语法转换器
	dataEngine.prototype.sizzle = function(selectStr){
		if(!selectStr){
			return;
		}
		var reg = /\[(.+?)\]/g;
		var selectList = selectStr.split(">");
		var resultList = [];
		
		for(var i = 0; i < selectList.length; i++){
			var data = selectList[i];
			if(data){				
				var key = null,value = null;
				//先取出值
				if(reg.test(data)){
					var tempValue =data.match(reg)[0];
					data = data.substr(0,data.length - tempValue.length);
					value = tempValue.substr(1,tempValue.length-2);
				}
				//再设置key
				key = data;
				resultList.push({
					key:key,
					value:value
				});
			}			
		}
		
		return resultList;	
	};
	
	//数据引擎选择器
	dataEngine.prototype.$ = dataEngine.prototype.selector = function(select,source){
		var selectResult = [];
		if(typeof select == "object"){
			var searchList = [];
			if($.isArray(select)){
				searchList = select;
			}else{
				searchList.push(select);
			}
			for(var i = 0; i < searchList.length; i++){
				var searchOne = searchList[i];
				for(var key in searchOne){
					selectResult.push({
						key:key,
						value:searchOne[key]
					});
				}			
			}
		}else if (typeof select == "number"){
			selectResult.push({
				value:select
			});
		}else{
			selectResult = this.sizzle(select);
		}
		
		var selectData = this.getData(selectResult,source);
		
		return this.constructionResult(selectData);
	};
	
	//构造返回对象
	dataEngine.prototype.constructionResult = function(selectData){
		var that = this;
		var result = {
				data:selectData,
				val:function(){									//返回只读文本
					return  JSON.parse(JSON.stringify(selectData));
				},
				add:function(option){},					//向列表插入数据
				remove:function(option){},				//向列表中删除数据，option可以是数值下标或者是一个查找条件对象
				attr:function(option,deep){},			//对查找对象结果进行操作，当option为空时返回数据对象selectData，当option为字符串时返回selectData[option]，
																		//当option为对象时对selectData的属性值进行设置，此时如果deep为true则进行深度设置
				find:function(option){}					//继续向后查找
		};
		
		if(selectData && typeof selectData == "object"){
			if($.isArray(selectData)){
				//当返回值是数组时会有add()和remove()方法
				result.add = function(option){
					if(option){
						that.addListData(selectData,option);
					}
					return this;
				};
				result.remove = function(option){
					that.removeListData(selectData,option);
					return this;
				};
			}else{
				//当返回值是对象时会有attr()方法
				result.attr = function(option,deep){
					if(option){
						if(typeof option == "object"){						
							that.setData(selectData,option,deep);					
							return this;
						}else{
							return selectData[option];
						}
					}else{
						return selectData;
					}
				};
			}
			
			//对象和数组都拥有find方法
			result.find = function(option){
				return that.$(option,selectData);
			};
		}
		return result;	
	};
	
	//新增数据
	dataEngine.prototype.addListData = function(dataList,data){
		if($.isArray(dataList)){
			dataList.push(data);
		}else{
			console.log("dataList参数必须是数组类型");
		}
	};
	
	//删除数据
	//condition可以是数值下标，也可以是一个有键值对的对象
	dataEngine.prototype.removeListData = function(dataList,condition){
		if($.isArray(dataList)){
			var conditionNum = Number(condition);
			if(isNaN(conditionNum)){
				if(typeof condition == "object"){
					var tempCondition;
					if(condition.hasOwnProperty("key") && condition.hasOwnProperty("value")){
						tempCondition = condition;
					}else{
						for(var key in condition){
							if(condition.hasOwnProperty(key)){
								tempCondition = {key:key,value:condition[key]};
							}
						}
					}
					
					if(!tempCondition){
						console.log("condition参数不能是空对象");
						return;
					}
					
					for(var i = dataList.length - 1; i >= 0; i--){
						if(dataList[i].hasOwnProperty(tempCondition.key) && dataList[i][tempCondition.key] == tempCondition.value){
							dataList.splice(i,1);
						}
					}
				}else{
					console.log("condition参数必须是数值类型或者键值对");
				}
			}else{
				dataList.splice(condition,1);
			}
		}else{
			console.log("dataList参数必须是数组类型");
		}
	};
	
	//获取数据
	dataEngine.prototype.getData = function(search,source){		
		var searchData;
		if(source){
			searchData = source;
		}else{
			searchData = this.view;
		}
		if(search){
			return this.searchData(0,search,searchData);
		}else{
			return searchData;
		}		
	};
	
	//设置数据
	dataEngine.prototype.setData = function(data,obj,deep){
		if(typeof data == "object" && !$.isArray(data) && typeof obj == "object" && !$.isArray(obj)){			
			for(var objKey in obj){
				if(obj.hasOwnProperty(objKey)){
					if(deep){
						this.deepExecute(0,data,function(key,resultData){
							if(key == objKey){
								resultData[key] = obj[objKey];
							}
						});
					}else{
						data[objKey] = obj[objKey];
					}					
				}
			}			
		}else{
			console.log("data参数和obj必须是对象类型");
		}	
		return this;
	};
	
	/*	深度执行方法
	 * count 			递归计数器(用于防止死循环，传0参数)
	 * data				操作数据源
	 * callbackFun	回调
	 * */
	dataEngine.prototype.deepExecute = function(count,data,callbackFun){
		if(count > 10000){
			return;
		}
		if(typeof data == "object"){
			if($.isArray(data)){
				for(var i = 0; i < data.length; i++){
					this.deepExecute(count++,data[i],callbackFun);
				}
			}else{
				for(var key in data){
					if(typeof data[key] == "object"){
						this.deepExecute(count++,data[key],callbackFun);
					}else{
						callbackFun(key,data);
					}					
				}
			}
		}	
	};
	
	//导出纯模型数据
	dataEngine.prototype.exportData = function(){
		var copyView = JSON.parse(JSON.stringify(this.view));
		var disableList = this.getDisableProperty();
		this.deepExecute(0,copyView,function(key,data){
			for(var i = 0; i < disableList.length; i++){
				if(key == disableList[i]){
					delete data[key];
				}
			}
		});
		return copyView;
	};	
	
	//初始化设置数据
	dataEngine.prototype.setInitData = function(view){
		this.view = view;
	};	
	
	window.DataEngine = function(){
		var tempPlugin = new dataEngine();		
		return tempPlugin;
	};
	
	
})(jQuery);