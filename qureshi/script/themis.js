
    (function($)
    {	
        /**********************************************************************/

        var Themis=function(themis,page)
        {
            /******************************************************************/

            var $this=this;

            $this.page=page;

			$this.themis=$(themis);
            
            $this.themisWindow=$('#themis-window');
            $this.themisWindowScroll=$('#themis-window-scroll');
            $this.themisWindowContent=$('#themis-window-content');
            
            $this.themisCloseButton=$('#themis-close-button');
            
            $this.enable=true;
            $this.scrollbar='';

            $this.currentHash='';
            $this.previousHash='';
            
            $this.currentPage=-1;
            $this.previousPage=-1;
			
			$this.themisVerticalMenuSlider='';
			$this.themisHorizontalMenuSlider='';
	
			$this.themisHeight=parseInt($('#themis').css('height'));
			$this.themisVericalMenuElementWidth=parseInt($('#themis-vertical-menu li:first').css('width'));
			
			$this.themisVericalMenuElementLeft=800;
			
			$this.themisWindowWidthExpand=parseInt($('div.main').css('width'));
			$this.themisWindowWidthCollapse=321;
			
			$this.themisHorizontalMenuHeight=451;
			
			$this.themisVerticalMenuBoxWrapper=parseInt($('.themis-vertical-menu-box-wrapper').first().css('height'));
			
            /******************************************************************/
            /******************************************************************/

            this.load=function()
            {
                $this.handleHash();
				$this.createVerticalMenuSlider();
				$this.bindVerticalMenuHoverEvent();
            };
            
            /******************************************************************/
            /******************************************************************/

			this.bindVerticalMenuHoverEvent=function()
			{
				var themisVerticalMenu=$('#themis-vertical-menu');
				var themisVerticalMenuElement=themisVerticalMenu.children('li');
				
                themisVerticalMenuElement.hover(
                    function() 
                    {
                        $(this).find('.themis-vertical-menu-box-foreground').stop().animate({top:'80px'},250);
                        $(this).find('.themis-vertical-menu-box-foreground-hover').stop().animate({top:'80px',opacity:1},250);

                        $(this).find('.themis-vertical-menu-box-icon-hover').stop().animate({opacity:1}); 
                        $(this).find('.themis-vertical-menu-box-background').stop().animate({top:'0px'},500); 
                    },
                    function()
                    {
                        $(this).find('.themis-vertical-menu-box-foreground').stop().animate({top:'0px'},250);
                        $(this).find('.themis-vertical-menu-box-foreground-hover').stop().animate({top:'0px',opacity:0},250);

                        $(this).find('.themis-vertical-menu-box-icon-hover').stop().animate({opacity:0}); 
                        $(this).find('.themis-vertical-menu-box-background').stop().animate({top:'-30px'},500); 
                    }
                );				
			};
			
			/******************************************************************/
			
			this.bindHorizontalMenuHoverEvent=function()
			{
				var themisHorizontalMenu=$('#themis-horizontal-menu');
				var themisHorizontalMenuElement=themisHorizontalMenu.children('li');
				
                themisHorizontalMenuElement.hover(
                    function() 
                    {
                        $(this).find('.themis-horizontal-menu-icon').stop().animate({opacity:0},250);
						$(this).find('.themis-horizontal-menu-icon-hover').stop().animate({opacity:1},250);
                    },
                    function()
                    {
						if(!$(this).hasClass('selected'))
						{
							$(this).find('.themis-horizontal-menu-icon').stop().animate({opacity:1},250);
							$(this).find('.themis-horizontal-menu-icon-hover').stop().animate({opacity:0},250);
						}
                    }
                )					
			};			

			/******************************************************************/

			this.createVerticalMenuSlider=function()
			{
				var themisVerticalMenu=$('#themis-vertical-menu');
				$this.themisVerticalMenuSlider=themisVerticalMenu.bxSlider(
				{
					auto:false,
					pause:1000,
					nextText:null,
					prevText:null,
					mode:'horizontal',
					displaySlideQty:5,
					infiniteLoop:true,
					hideControlOnEnd:false,
					wrapperClass:'bx-wrapper bx-wrapper-vertical-menu'
				});					
			}
			
			/******************************************************************/
			
			this.createHorizontalMenuSlider=function()
			{
				var themisHorizontalMenu=$('#themis-horizontal-menu');
				$this.themisHorizontalMenuSlider=themisHorizontalMenu.bxSlider(
				{
					auto:false,
					pause:1000,
					nextText:null,
					prevText:null,
					mode:'vertical',
					displaySlideQty:5,
					infiniteLoop:true,
					hideControlOnEnd:false,
					wrapperClass:'bx-wrapper bx-wrapper-horizontal-menu'
				});					
			}
			
			/******************************************************************/
			/******************************************************************/

            this.handleHash=function()
            {
                if(window.location.hash=='') window.location.href='#!/main';
    	
                $this.currentHash=window.location.hash;	
                if($this.currentHash!=$this.previousHash) $this.doHash();

                $(window).bind('hashchange',function(event) 
                {
                    event.preventDefault();

                    if($this.isEnable()==false) return;
					
                    $this.currentHash=window.location.hash;
                    $this.doHash();
                    $this.previousHash=$this.currentHash;
                });  
            };
            
            /******************************************************************/
            
            this.doHash=function()
            {
                if(!$this.enable) return(false);
                $this.enable=false;
                
                var isOpen=$this.isOpen();
                var currentPage=$this.checkHash();

                if(currentPage==false) 
                {
                    $this.enable=true;
                    return(false);
                }
                
                $this.currentPage=currentPage;
                if($this.previousPage==-1) 
                    $this.previousPage=$this.currentPage;
                
				$this.selectHorizontalMenu();
				
                if($this.currentPage==-1)
				{
					if(isOpen) $this.close();
					else $this.enable=true;
				}
				else $this.open(isOpen);   

                return(true);
            };
            
            /******************************************************************/
            
            this.checkHash=function()
            {
                if($this.currentHash=='#!/main') return(-1);
                
                for(var id in $this.page)
                {
                    if('#!/'+id==$this.currentHash) return(id);
                };
                
                return(false);
            };
            
            /******************************************************************/
            
            this.open=function(isOpen)
            {				
                if(isOpen)
                {
                    $this.closePage({onComplete:function() 
                    {
                        $this.openPage({onComplete:function() { }});
                    }});   
                }
                else
                {
                    $this.collapseVerticalMenu({onComplete:function() 
                    {
                        $this.expandHorizontalMenu({onComplete:function() 
                        {
                            $this.openPage({onComplete:function() { }});
                        }});
                    }}); 
                };               
            };
            
            /******************************************************************/
            
            this.close=function()
            {
                $this.showCloseButton(false);
                $this.closePage({onComplete:function()   
                {
                    $this.collapseHorizontalMenu({onComplete:function() 
                    {
                        $this.expandVerticalMenu({onComplete:function()
                        {
							$this.enable=true;
                        }});
                    }});
                }});
            };
            
            /******************************************************************/
            
            this.collapseVerticalMenu=function(event)
            {
                var i=0,j=0;
				
				var themisVerticalMenu=$('#themis-vertical-menu');
				var themisVerticalMenuElement=themisVerticalMenu.find('li');
				var themisVerticalMenuElementCount=themisVerticalMenuElement.length;
			
                themisVerticalMenuElement.each(function() 
                {
                    $(this).children('div.themis-vertical-menu-box-wrapper').animate({height:'0px'},getRandom(500,1000),'easeInOutExpo',function() 
                    {						
                        if((++i)==themisVerticalMenuElementCount)
                        {
							$this.themisVerticalMenuSlider.destroyShow();
							themisVerticalMenuElement.css('position','absolute');
							
							themisVerticalMenuElement.each(function() 
							{
								var index=$(this).parent('ul').children('li').index($(this));
								$(this).css('left',$this.themisVericalMenuElementWidth*index);
							});
							
                            themisVerticalMenuElement.animate({left:$this.themisVericalMenuElementLeft,opacity:0},500,function() 
                            {
                                if((++j)==themisVerticalMenuElementCount)
                                {
                                    themisVerticalMenuElement.css('display','none');
									$this.doEvent(event);
									return;
                                }
                            });
                        }
                    });                  
                });                               
            };
			
            /******************************************************************/
            
            this.expandVerticalMenu=function(event)
            {
				var i=0;
				
				var themisVericalMenu=$('#themis-vertical-menu');
				var themisVericalMenuElement=themisVericalMenu.children('li');
				var themisVericalMenuElementCount=themisVericalMenuElement.length;
				
				themisVericalMenu.css('height',$this.themisHeight);

                themisVericalMenuElement.each(function() 
                {
					$(this).css(
					{
						'left'		: $this.themisVericalMenuElementLeft,
						'display'	: 'block',
						'opacity'	: 1,
						'position'	: 'absolute'					
					});
					
                    $(this).children('div.themis-vertical-menu-box-wrapper').animate({height:$this.themisVerticalMenuBoxWrapper},500,'easeInOutExpo',function() 
                    {
						var element=$(this).parent('li');
						var index=themisVericalMenuElement.index(element);
                        var left=$this.themisVericalMenuElementWidth*index;
						
						element.animate({left:left},500,function() 
						{
							$(this).css('position','static');
							
							if((++i)==themisVericalMenuElementCount)
							{
								$this.createVerticalMenuSlider();
								$this.bindVerticalMenuHoverEvent();	
								$this.doEvent(event);
							}
						});
                    });                  
                });                               
            };           

            /******************************************************************/
            
            this.expandHorizontalMenu=function(event)
            {
				var themisHorizontalMenu=$('#themis-horizontal-menu-wrapper');
				
                $this.themisWindow.css('display','block');
                themisHorizontalMenu.animate({height:$this.themisHorizontalMenuHeight},500,function() 
                {
					$this.createHorizontalMenuSlider();
					$this.bindHorizontalMenuHoverEvent();
                    $this.doEvent(event);
                });
            };
            
            /******************************************************************/
            
            this.collapseHorizontalMenu=function(event)
            {
				var themisHorizontalMenu=$('#themis-horizontal-menu-wrapper');
				
                themisHorizontalMenu.animate({height:'0px'},500,function() 
                {
					$this.themisHorizontalMenuSlider.destroyShow();
					$this.themisWindow.css('display','none');
                    $this.doEvent(event);
                });
            };            
            
            /******************************************************************/
            
            this.expandWindow=function(event)
            {
                $this.themisWindow.animate({width:$this.themisWindowWidthExpand},500,'easeOutExpo',function() 
                {
                    $this.doEvent(event);
                });
            };
            
            /******************************************************************/
            
            this.collapseWindow=function(event)
            {
                $this.themisWindow.animate({width:$this.themisWindowWidthCollapse},100,'easeInOutSine',function() 
                {
                    $this.doEvent(event);
                });               
            };
            
            /******************************************************************/
            
            this.closePage=function(event)
            {
				$(':input,a').qtip('destroy');
                $this.collapseWindow({onComplete:function() 
                {
                    $this.themisWindowContent.html(''); 
                    $this.themisWindowScroll.css('display','none');

                    $this.doEvent(event);
                }});
            };
            
            /******************************************************************/
            
            this.openPage=function()
            {
                $.get('page/'+$this.getPageData($this.currentPage,'html'),{},function(page) 
                {	
                    $this.themisWindowScroll.css('display','block');
                    $this.themisWindowContent.html(page);                    

                    jQuery.getScript('page/script/base.js',function() 
                    {
                        if($this.getPageData($this.currentPage,'js')!='')
                            jQuery.getScript('page/script/'+$this.getPageData($this.currentPage,'js'));
                    });
                    
                    $this.createScrollbar();

                    $this.expandWindow({onComplete:function() 
                    {
                        $this.enable=true;
                        $this.showCloseButton(true);
                        $this.previousPage=$this.currentPage;
                    }});            
                },
                'html');             
            };
            
            /******************************************************************/
            
            this.createScrollbar=function()
            {
                $this.scrollbar=$('#themis-window-scroll').jScrollPane({maintainPosition:false,autoReinitialise:true}).data('jsp');
            };

            /******************************************************************/
            /******************************************************************/
              
            this.showCloseButton=function(show)
            {
                $this.themisCloseButton.css('display',show ? 'block' : 'none');
            };
            
            /******************************************************************/
              
            this.isOpen=function()
            {
                return($this.currentPage==-1 ? false : true);
            };
            
            /******************************************************************/
            
            this.isEnable=function()
            {
                if(!$this.enable)
                {
					if($this.previousHash!='')
						window.location.href=$this.previousHash;
                    return(false);
                }  
                
                return(true);
            };
            
            /******************************************************************/
            
            this.getPageData=function(key,property)
            {
                return($this.page[key][property]);
            };
            
            /******************************************************************/
            /******************************************************************/
            
            this.doEvent=function(event)
            {
                if(typeof(event)!='undefined')
                {
                    if(typeof(event.onComplete)!='undefined') event.onComplete.apply();
                };                  
            };
			
			/******************************************************************/
			
			this.selectHorizontalMenu=function()
			{	
				var themisHorizontalMenu=$('#themis-horizontal-menu');
				var themisHorizontalMenuElement=themisHorizontalMenu.children('li');
				
				themisHorizontalMenuElement.removeClass('selected');
				themisHorizontalMenuElement.find('span.themis-horizontal-menu-icon').css('opacity',1);
				themisHorizontalMenuElement.find('span.themis-horizontal-menu-icon-hover').css('opacity',0);
				
				try
				{
					var object=themisHorizontalMenuElement.find('a[href="'+$this.currentHash+'"]').parent('li');
					object.addClass('selected');
					object.find('span.themis-horizontal-menu-icon').css('opacity',0);
					object.find('span.themis-horizontal-menu-icon-hover').css('opacity',1);
				}
				catch(e) {}
			};

            /******************************************************************/
        };


        /**************************************************************/

        $.fn.themis=function(page)
        {
            /***********************************************************/

            var themis=new Themis(this,page);
            themis.load();

            /***********************************************************/
        };

        /**************************************************************/

    })(jQuery);