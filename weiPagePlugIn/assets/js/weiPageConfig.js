//微页面配置文件
var weiPageConfig = {
		
		//引擎配置
		engineConfig:{
			plugIn:"plugInList",
			subPlugIn:"subPlugInList"
		},
		
		//映射配置
		mapperConfig:{
			plugIn:{								//插件映射
				"30":"product",
				"4":"banner",
				"2":"nav",
				"5":"quote",
				"3":"space",
				"1":"RTE",
				"6":"search"
			}
		},
		
		//特殊配置
		specialConfig:{
			plugInId:"identity",								//插件在显示（非编辑）状态时可以通过a标签导航锚点到对应的块，该块id由plugInIdTab + plugInId配置值的属性对应的值组成
			plugInIdTab:"M",													
			plugInIdViewTab:"plugInIdView"		//插件视图标识（插件redraw的时候会通过该标识+plugInUuid查找div的id找到要替换的块）
		},
		
		
		//插件配置
		plugInConfig:{
			main:{										//主数据（微页面最顶层数据对象，可以修改里面的属性，但不能省略该对象）
				data:{
					title:"",
					descr:"",
					backgroundColor:"",
					categoryId:"",
					templateId:"",
					picUrl:"",
					remark:"",
					plugInList:"",
					weiPageIdStr:"",
					plugInList:[]
					//delIdsStr:""
				},
				template:{
					edit:{
						plugIn:"weiPage_edit"
					}
				}
			},
			
			product:{									//商品插件
				data:{
					plugIn:{
						plugInIdStr: "",
			             displayNo: "",
			             identity: "",
			             backgroundColor: "#F1F0F6",
			             showbgPicUrl:"",
			             bgPicUrl: "",
			             height: "",
			             width: "",
			             fullscreen: "",
			             txtHtml: "",
			             plugIntype: 30,
			             showType:1,
			             subPlugInList:[]
					},
					subPlugIn:{
						plugInProductIdStr: "",
			            	plugInIdStr: "",
			            	displayNo: 0,
			            	picUrl: "",
			            	price: "",
			            	originalPrice: "",
			            	descr: "",
			            	link: "",
			            	productId: "",
			            	productIdStr:"",
			            	tag:"",
			            	title: "",
			            	stype: 1,
			            	showpicUrl:"",
			            	plugIntype: 30,
				        showType:1
					}
				},
				template:{
					view:{
						plugIn:{
							"1": "product_stream_view",
			                 "2": "product_list_view",
			                 "5": "product_gridding_view",
			                 "6": "product_bigImg_view"
						},
						subPlugIn:{
							 "1": "product_stream_child_view",
				              "2": "product_list_child_view",
				              "5": "product_gridding_child_view",
				              "6": "goods_bigImg_child_view"
						}
					},
					edit:{
						plugIn: "product_edit"
					}
				},
				initData:{
					subPlugInNum : 4			//初始化子插件数量
				}
			},
			
			banner:{								//焦点图插件
				data:{	
					plugIn:{
						plugInIdStr: "",
			            	displayNo: 0,
			            	identity: "",
			            	backgroundColor: "",
			            	bgPicUrl: "",
			            	height: 0,
			            	width: 0,
			            	fullscreen: 0,
			            	txtHtml: "",
			            	plugIntype: 4,
			            	showType:0,		            
			            	subPlugInList:[]
					},
					subPlugIn:{
						plugInCommonIdStr: "",
			            	plugInIdStr: "",
			            	name: "",
			            	displayNo: 0,
			            	picUrl: "",
			            	link: "",
			            	linkType: 0,
			            	plugInType: 4,
			            	showType:0
					}
				},
				template:{
					view:{
						plugIn:{
							"0":"banner_list_view"
						},
						subPlugIn:{
							"0":"banner_list_child_view"
						}
					},
					edit:{
						plugIn:"banner_edit",
						subPlugIn:"banner_child_edit"
					}
				},
				initData:{
					subPlugInNum : 1			//初始化子插件数量
				}
			},
			
			nav:{									//导航插件
				data:{	
					plugIn:{
						plugInIdStr: "",
			            	displayNo: 0,
			            	identity: "",
			            	backgroundColor: "#FFFFFF",
			            	bgPicUrl: "",
			            	height: 0,
			            	width: 0,
			            	fullscreen: 0,
			            	txtHtml: "",
			            	btnColor:"#FFFFFF",
			            	btnSelectedColor:"#138ED4",
			            	plugIntype: 2,
			            	showType:20,
			            	subPlugInList:[]
					},
					subPlugIn:{
						plugInCommonIdStr: "",
			            	plugInIdStr: "",
			            	name: "",
			            	displayNo: 0,
			            	picUrl: "",
			            	link: "",
			            	linkType: 0, 			            	
			            	btnColor:"#FFFFFF",
			            	btnSelectedColor:"#138ED4",
			            	showPicUrl:"",
			            	plugInType: 2,
			            	showType:20
					}
				},
				template:{
					view:{
						plugIn:{
							"20":"nav_list_view",
							"21":"nav_picture_view"
						},
						subPlugIn:{
							"20":"nav_list_child_view",
							"21":"nav_picture_child_view"
						}
					},
					edit:{
						plugIn:"nav_edit",
						subPlugIn:"nav_child_edit"
					}
				},
				initData:{
					subPlugInNum : 4			//初始化子插件数量
				}
			},
			
			quote:{									//引用页面插件
				data:{
					plugIn:{
						plugInIdStr: "",
			            	displayNo: 0,
			            	identity: "",
			            	backgroundColor: "#F1F0F6",
			            	bgPicUrl: "",
			            	height: 0,
			            	width: 0,
			            	txtHtml: "",		            	
			            	relatedWeiPageIdStr: "",
			            	relatedWeiPageTitle:"",
			            	btnSelectedColor: "",
			            	btnColor: "",
			            	plugIntype: 5,
			            	showType:0,
			            	relatedWeiPageInfo:{}
					}
				},
				template:{
					view:{
						plugIn:{
							"0":"quote_view"
						}
					},
					edit:{
						plugIn:"quote_edit"
					}
				},
				initData:{
					
				}
			},
			
			space:{								//占位空白插件
				data:{
					plugIn:{
						plugInIdStr: "",
		            		displayNo: 0,
		            		identity: "",
		            		backgroundColor: "#F1F0F6",
		            		bgPicUrl: "",
		            		height: 50,
		            		width: 0,
		            		fullscreen: 0,
		            		txtHtml: "",
		            		showType:0,
		            		plugIntype: 3
					}	
				},
				template:{
					view:{
						plugIn:{
							"0":"space_view"
						}
					},
					edit:{
						plugIn:"space_edit"
					}
				},
				initData:{
					
				}
			},
			
			RTE:{									//富文本插件		
				data:{
					plugIn:{
						plugInIdStr: "",
			            	displayNo: 0,
			            	identity: "",
			            	backgroundColor: "#F1F0F6",
			            	bgPicUrl: "",
			            	height: 0,
			            	width: 0,
			            	fullscreen: 0,
			            	showType:0,
			            	txtHtml: "<p>点击编辑内容</p>",
			            	plugIntype: 1
					}
				},	
				template:{
					view:{
						plugIn:{
							"0":"RTE_view"
						}
					},
					edit:{
						plugIn:"RTE_edit"
					}
				},
				initData:{
					
				}
			},
			
			search:{								//搜索插件
				data:{
					plugIn:{
						plugInIdStr: "",
			             displayNo: 0,
			             identity: "",
			             backgroundColor: "",
			             bgPicUrl: "",
			             height: 0,
			             width: 0,
			             fullscreen: 0,
			             txtHtml: "",
			             showType:0,
			             plugIntype: 6,
			             subPlugInList:[]
					},
					subPlugIn:{
						plugInCommonIdStr: "",
			            	plugInIdStr: "",
			            	name: "",
			            	displayNo: 0,
			            	picUrl: "",
			            	link: "",
			            	linkType: -1,
			            	plugInType: 6,
			            	showType:0,
					}
				},	
				template:{
					view:{
						plugIn:{
							"0":"search_view"
						},
						subPlugIn:{
							"0":"search_child_view"
						}
					},
					edit:{
						plugIn:"search_edit",
						subPlugIn:"search_child_edit"
					}
				},
				initData:{
					subPlugInNum : 1			//初始化子插件数量
				}						
			}
			
		}
		
};