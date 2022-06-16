//define namespace
var lxt = lxt || {};
var module = {};
lxt = function(){
	'use strict';
	//Minimum width to display the desktop website
	var desktopWidth = 1025;
	var tabletWidth = 768;

	//Get file root
	var documentRoot = document.location.origin + '/';
	
	//Get current currency
	var currency = function(){
		var currency = document.querySelector("#settings-currency option:checked");
		return (currency) ? currency.innerText : false;
	};
	
	//Get current units (sq ft or sq m)
	var units = function(){
		var units = document.querySelector("#settings input[name=size]:checked");
		return (units) ? units.value : false;
	};
	
	//Get current language id
	var language = function(){
		var lang = document.getElementById("settings-language");
		return (lang) ? lang.value : false;
	};

	//Toggle element visibility
	var toggle = function(element){
		element.style.display = window.getComputedStyle(element, null).getPropertyValue('display') === "none" ? "block" : "none";
	};

	//Manipulating elements
	var getParent = function(element, identifier){
		element = element.parentElement || false;
		
		while(element !== false){
			if(typeof identifier === 'object'){
				if(element === identifier){
					return element;
				}
			}else if((identifier.match(RegExp(/^\./)) && element.classList.contains(identifier.replace(/\./gi, ""))) 
					|| (identifier.match(RegExp(/^\#/)) && element.id === identifier.replace(/\#/gi, "")) 
					|| element.tagName === identifier.toUpperCase()){
				return element;
			}

			element = (element.parentElement !== null) ? element.parentElement : false;
		}

		return null;
	};

	//Get direction of vertical scroll of window
	var getScrollYDirection = function(){
		//Scroll direction variables
		var lastScrollY = 0;
		var scrollDelta = 5;
		var current = window.scrollY;
		var direction;

		if(Math.abs(lastScrollY - current) <= scrollDelta){
			direction = 'none';
		}else if(current < lastScrollY){
			direction = 'up';
		}else{
			direction = 'down';
		}

		lastScrollY = current;

		return direction;
	};
	
	//Extends an object
	var extend = function (target, source) {
		if(typeof source === 'object'){
		    [].forEach.call(Object.getOwnPropertyNames(source), function(key){
		        Object.defineProperty(target, key, Object.getOwnPropertyDescriptor(source, key));
		    });
		}
	    return target;
	};
	//Get url parameters
	var getUrlParameters = function(){
		var vars = {};
		var regEx = /[a-zAz\-]+(\[\])+/;
		
		window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
			key = decodeURIComponent(key).replace(/\+/g, " ");
			value = decodeURIComponent(value).replace(/\+/g, " ");

			if(typeof vars[key] === "undefined" && regEx.exec(key)){
				vars[key] = [];
			}

			if(Array.isArray(vars[key]) || typeof vars[key] === "object"){
				vars[key].push(value);
			}else{
				vars[key] = value;
			}
		});

		vars.length = Object.keys(vars).length;

	  	return vars;
	};

	//Copy "protection"
	var addLinkOnCopy = function(){
		document.addEventListener("copy", function(){
			var body_element = document.getElementsByTagName("body")[0];
			var selection = window.getSelection();
			var date = new Date();
			var year = date.getFullYear();
			var pagelink = ("<span style='display:none'>Read more at: <a href='"+document.location.href+"'>"+document.location.href+"</a></span><br /><br />Read more at: <a href='"+document.location.href+"'>"+document.location.href+"</a><br />LUXHABITAT &copy; "+year);
			var copytext = selection + pagelink;
			var newdiv = document.createElement("div");

			newdiv.style.position = "absolute";
			newdiv.style.left = "-99999px";
			body_element.appendChild(newdiv);
			newdiv.innerHTML = copytext;
			selection.selectAllChildren(newdiv);

			window.setTimeout(function(){
				body_element.removeChild(newdiv);
			}, 0);
		});	
	};

	var ajax = function(options){
		var _this = this;
		var req = new XMLHttpRequest();
		var formData = null;
		var defaults = {
			url: null,
			method: 'POST',
			headers: {
				'Content-type': 'application/x-www-form-urlencoded'
			}, 
			formData: null,
			callbackFn: false
		};
		options = lxt.extend(defaults, options);

		//Open connection
		req.open(options.method, options.url);

		//Set headers
		if(options.headers){
			for(var name in options.headers){
				req.setRequestHeader(name, options.headers[name]);
			}
		}

		//If we receiv a 200 execute the callback function
		req.onreadystatechange = function(){
		  if (req.readyState != 4 || req.status != 200) return;
		  if(req.readyState == 4){
		  	if(req.status == 200){

		  		if(typeof options.callbackFn === 'function'){
		  			options.callbackFn(req.responseText);
		  		}
		  	}
		  }
		};

		//Set parameters
		if(options.formData !== null){
			formData = Object.keys(options.formData).map(function(key){
				return key + '=' +encodeURIComponent(options.formData[key]);
			}).join('&');
		}

		req.send(formData);

		this.abort = function(){
			req.abort();
		};

		return this;
	};

	var observerList = function(){
		var observers = [];

		var add = function(observer){
			observers.push(observer);
		};

		var get = function(index){
			if(index > -1 && index <= observers.length){
				return observers[index];
			}
		};

		var count = function(){
			return observers.length;
		};

		return {
			add: add,
			get: get,
			count: count
		};
	};

	var slug = function(value){
		var unwanted = ["&aacute;","&eacute;","&iacute;","&oacute;","&uacute;", "á", "à", "é", "è", "í", "ì", "ó", "ò", "ú", "ù", "ï", "ü", "ñ","ç", "Á", "À", "É", "È", "Í", "Ì", "Ó", "Ò", "Ú", "Ù", "Ï", "Ü", "Ñ", "Ç","â","Â","ê","Ê","î","Î","ô","Ô","û","Û"];
		var accepted = ["a","e","i","o","u", "a", "a", "e", "e", "i", "i", "o", "o", "u", "u", "i", "u", "n", "c", "a", "a", "e", "e", "i", "i", "o", "o", "u", "u", "i", "u", "n", "c","a","a","e","e","i","i","o","o","u","u"];

		value = value.toLowerCase().trim();

		unwanted.forEach(function(v, k){
			value = value.replace(new RegExp(v, "g"), accepted[k]);
		});
		
		//Remove anything that is not accepted letters and numbers
	    value = value.replace(/[^a-z0-9_\s-]/g, "");
	    //Remove unanted spaces 
	    value = value.replace(/[\s-]+/g, " ");
		//Replace spaces with -
	    value = value.replace(/[\s_]/g, "-");

	    return value;
	};

	var capitalize = function(value){
		return value.charAt(0).toUpperCase() + value.slice(1);
	};

	var numberWithCommas = function(x){
	    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
	};

	var click = function(trigger, callbackFn){
		if(document.getElementsByClassName(trigger).length > 0){
			(function(){
				var triggers = document.getElementsByClassName(trigger);
				var quantity = triggers.length;
				var i = 0;

				for(i = 0; i < quantity; i++){
					triggers[i].addEventListener("click", function(e){
						e.preventDefault();
						e.stopPropagation();

						if(typeof callbackFn === 'function'){
				  			callbackFn.call(this);
				  		}
					});
				}
			})();
		}
	};

	return {
		addLinkOnCopy: addLinkOnCopy(),
		ajax: ajax,
		currency: currency(),
		desktopWidth: desktopWidth,
		extend: extend,
		getParent: getParent,
		getScrollYDirection: getScrollYDirection,
		getUrlParameters: getUrlParameters,
		language: language(),
		root: documentRoot,
		tabletWidth: tabletWidth,
		toggle: toggle,
		units: units(),
		observerList: observerList,
		slug: slug,
		capitalize: capitalize,
		numberWithCommas: numberWithCommas,
		click: click,
		//There are two sub-namespaces that must be pre-defined
		ui: {},
		form: {}
	};
}();
/*
lxt.fb = function(){
	'use strict';

	var init = function(){
		FB.init({
			appId      : '957104227763059',
			xfbml      : true,
			version    : 'v9.0'
		});
		
		FB.AppEvents.logPageView();
	};

	var checkLoginState = function(){
		FB.getLoginStatus(function(response) {
			lxt.fb.statusChangeCallback(response);
		});
	};

	var statusChangeCallback = function(response){
		if (response.status === 'connected'){ //If connected to the app
		  	FB.api('/me', 'get', { fields: 'id,name,email' }, function(response) {
		      	var container = document.getElementsByClassName('facebook-form')[0];
		        var form = document.createElement('form');
		        form.action = lxt.root+"login/process/";
		        form.method = "post";
		        form.classList.add("hidden");

		        var id_input = document.createElement("input");
		        id_input.name = 'id';
		        id_input.value = response.id;

		        var email_input = document.createElement("input");
		        email_input.name = 'email';
		        email_input.value = response.email;

		        var source_input = document.createElement("input");
		        source_input.name = 'source';
		        source_input.value = "facebook";

		        var name_input = document.createElement("input");
		        name_input.name = 'name';
		        name_input.value = response.name;

		        var url_input = document.createElement("input");
		        url_input.name = 'url';
		        url_input.value = window.location.href;

		        form.appendChild(id_input);
		        form.appendChild(email_input);
		        form.appendChild(source_input);
		        form.appendChild(name_input);
		        form.appendChild(url_input);
		        container.appendChild(form);

		        form.submit();
		    });
		}
	};
	
	return {
		init: init,
		checkLoginState: checkLoginState,
		statusChangeCallback: statusChangeCallback
	};
}();
*/
lxt.filters = function(){
	'use strict';

	var filters = {};

	var filtered = function(){
		return (typeof lxt.getUrlParameters() !== "undefined");
	}();

	var overlay = null;
	var currentURL;	
	var filteringRequest = null;

	//Prepare urls
	var saleUrl = L.type_for_operation;
	saleUrl = lxt.slug(saleUrl.replace('{type}', L.types.property).replace('{operation}', L.sale.name));
	var rentUrl = L.type_for_operation;
	rentUrl = lxt.slug(rentUrl.replace('{type}', L.types.property).replace('{operation}', L.rent.name));
	var curatedProjectsUrl = lxt.slug(L.curated_projects.link);
	var developmentsUrl = lxt.slug(L.developments.link);

	var getUrl = function(){
		currentURL = lxt.root;
		var RegExOperation = new RegExp('(' + lxt.slug(L.sale.name) + '|' + lxt.slug(L.rent.name) + ')');
		var auxiliarUrl = decodeURI(document.URL).split("?")[0];

		if(RegExOperation.test(auxiliarUrl)){
			currentURL += ((RegExp(lxt.slug(L.sale.name)).test(auxiliarUrl)) ? saleUrl : rentUrl) + "/";
		}else{
			if(auxiliarUrl.indexOf(curatedProjectsUrl) !== -1){
				currentURL += curatedProjectsUrl + "/";
			}else if(auxiliarUrl.indexOf(developmentsUrl) !== -1){
				currentURL += developmentsUrl + "/";
			}
		}
	};

	var isAutomatic = function(){
		return (document.getElementsByClassName("filtered-content").length > 0) ? true : false;
	}();

	var processFilters = function(){
		if(filteringRequest !== null){
			filteringRequest.abort();
		}

		//Process selected filters
		buildFilterObject();

		//Build filtered URL
		var filteredURL = buildFilteredURL();

		//If we are not on a money page we redirect the user
		if(!isAutomatic){
			window.location.href = filteredURL;
			return false;
		}
		
		//Replace the title with a message to let know the user the the filtering is taking place
		document.getElementById("filtered").getElementsByTagName("header")[0].getElementsByTagName("h1")[0].innerText = L.filters.filtering;
		
		//Add overlay while we filter the results
		addOverlay();
		
		window.history.replaceState({ url : "search", "pageTitle" : L.filters.results },"", filteredURL);
		
		//Query for filtered results
		filteringRequest = lxt.ajax({
			url: filteredURL,
			callbackFn: function(data){
				//First, parse the response
				var parser = new DOMParser();
				data = parser.parseFromString(data, "text/html");

				if(data != "error"){
					processFilterResponse(data);
					removeOverlay();
				}

				//Update filtered state
				if(!filtered){
					filtered = true;
				}

				filteringRequest = null;
			}
		});
	};

	//Build filters object
	var buildFilterObject = function(){
		//filter aux is used to select filters and process them
		var filterAux;
		var i;
		var filterDOM = document.getElementsByClassName('filters')[0];

		if(filterDOM){
			//Defaults
			filters = {};
			filters.area = [];
			filters.development = [];
			filters.ref = [];
			filters.status = [];
			filters.type = [];
			filters.bedrooms = [];
			filters.city = [];
			filters.rentalperiod = [];
			filters.minsize = null;
			filters.maxsize = null;
			filters.minprice = null;
			filters.maxprice = null;

			//Type, beds and city
			filterAux = filterDOM.querySelectorAll("li.active > label");
			for(i = 0; i < filterAux.length; i++){
				switch(filterAux[i].dataset.rel){
					case "status":
						filters.status.push(filterAux[i].dataset.id);
						break;

					case "type":
						filters.type.push(filterAux[i].dataset.id);
						break;

					case "bedrooms":
						filters.bedrooms.push(filterAux[i].dataset.id);
						break;

					case "city":
						filters.city.push(filterAux[i].dataset.name);
						break;

					case "rental_period":
						filters.rentalperiod.push(filterAux[i].dataset.id);
						break;
				}
			}

			//Areas and developments
			filterAux = filterDOM.getElementsByClassName("filter-location");
			if(filterAux !== null){
				for(i = 0; i < filterAux.length; i++){
					switch(filterAux[i].dataset.type){
						case 'area':
							filters.area.push(filterAux[i].dataset.id.trim());
							break;

						case 'development':
							filters.development.push(filterAux[i].dataset.id.trim());
							break;

						case 'ref':
							filters.ref.push(filterAux[i].dataset.id.trim());
							break;
					}
				}
			}

			//Size
			var min_size = filterDOM.getElementsByClassName("min-size")[0];
			var max_size = filterDOM.getElementsByClassName("max-size")[0];
			
			if(min_size && min_size.value != "default"){
				filters.minsize = min_size.value;
			}
			if(max_size && max_size.value != "default"){
				filters.maxsize = max_size.value;
			}

			//Price
			var min_price = filterDOM.getElementsByClassName("min-price")[0];
			var max_price = filterDOM.getElementsByClassName("max-price")[0];
			if(min_price && min_price.value != "default"){
				filters.minprice = min_price.value;
			}
			if(max_price && max_price.value != "default"){
				filters.maxprice = max_price.value;
			}
			
			for(i in filters){
				if((Array.isArray(filters[i]) && filters[i].length === 0) || filters[i] === null){
					delete filters[i];
				}
			}

			toggleClearFiltersButton(filters);
		}
	};

	//Transforms an object into a valid url param string
	var stringifyFilterObject = function(){
		var filterString;

		filterString = Object.keys(filters).map(function(key){
			if(Array.isArray(filters[key])){
				return filters[key].map(function(value){
					return key +'[]=' + value; 
				}).join('&');
			}else{
				return key + '=' +filters[key];
			}
		}).join('&');

		return filterString;
	};

	//Build a valid filtered or unfiltered URL
	var buildFilteredURL = function(){
		//Get initial url
		if(typeof currentURL === 'undefined'){
			getUrl();
		}

		//Final url
		var filteredURL = currentURL;
		//Once finished
		//We need to transform the filters object into a valid url param string
		var filterString = stringifyFilterObject();

		//Check if there is an operation filter
		//In case there is, probably we are NOT in a money page and we'll need to redirect our users.
		//In any case we have to alter the current URL accordingly
		if(document.querySelector(".filter-item.operation") !== null){
			if(!currentURL.match(new RegExp(lxt.slug(L.sale.name))) 
			   && !currentURL.match(new RegExp(lxt.slug(L.rent.name))) 
			   && !currentURL.match(new RegExp(lxt.slug(L.curated_projects.link)))){
				if(document.querySelector(".filter-item.operation li.active label").dataset.id.match(/rent/)){
					filteredURL = currentURL + rentUrl + "/";
				}else{
					filteredURL = currentURL + saleUrl + "/";
				}
			}
		}

		//If there are any filters applied we return the valid filtered url
		if(filterString !== ''){
			return encodeURI(filteredURL+"?filters=true&"+filterString);
		//Otherwise we return a clean url with no param
		}else{
			return encodeURI(filteredURL);
		}
	};

	var addOverlay = function(){
		if(overlay === null){
			var currentContent = document.getElementsByClassName("filtered-content")[0];

			//Set up the content are to add an overlay
			currentContent.style.position = "relative";
			currentContent.style.width = "100%";
			currentContent.style.overflow = "hidden";

			//Create an overlay
			overlay = document.createElement("div");
			overlay.classList.add("temp-cover");
			
			//Put it over the the content and show
			currentContent.appendChild(overlay);
			setTimeout(function(){overlay.style.backgroundColor = "rgba(0,0,0,.75)"; }, 50);
		}
	};

	var removeOverlay = function(){
		if(overlay !== null){
			overlay.style.backgroundColor = "rgba(0,0,0,0)";
			setTimeout(function(){
				overlay.remove();
				overlay = null;
			}, 150);
		}
	};

	var processFilterResponse = function(data){
		//This are all page elements that we have on a money page. They might all change
		//Content: list of houses
		//Header: includes title, location block
		//Breadcrumbs
		//Matches marker

		//Get the page elements from the response
		var newContent = data.querySelector(".filtered-content");
		var newHeader = data.getElementById("filtered").querySelector("h1");
		var newBreadcrumbs = data.getElementById("breadcrumbs");
		var newMatches = data.getElementById("filtered").querySelector(".matches");
		var newSort = data.getElementById("filtered").querySelector(".sort-by");
		
		//We need to find out if we have a SEO content block at the top
		var locationBlock = document.querySelector('.location-block') || null;

		//Get all the current page elements
		var currentContent = document.querySelector(".filtered-content");
		var currentHeader = document.getElementById("filtered").querySelector("h1");
		var currentBreadcrumbs = document.getElementById("breadcrumbs");
		var currentMatches = document.getElementById("filtered").querySelector(".matches");
		var currentSort = document.getElementById("filtered").querySelector(".sort-by");

		//Replace with the new content
		currentContent.parentElement.replaceChild(newContent, currentContent);

		//Replace Header
		if(currentHeader){
			currentHeader.parentElement.replaceChild(newHeader, currentHeader);
		}

		//Replace the matches
		if(currentMatches){
			if(newMatches){
				currentMatches.parentElement.replaceChild(newMatches, currentMatches);
			}else{
				currentMatches.innerText = '0 results';
			}
		}

		if(currentSort){
			currentSort.parentElement.replaceChild(newSort, currentSort);
		}

		//We remove the SEO location block in case of changed of location
		if(locationBlock !== null && (typeof filters.area !== 'undefined' && (filters.area.length > 1 || locationBlock.dataset.name.trim() !== filters.area[0].trim()))){
			locationBlock.remove();
			lxt.getParent(newMatches, 'nav').classList.add('brd');
		}

		//Replace the breadcrumbs
		if(currentBreadcrumbs){
			currentBreadcrumbs.parentElement.replaceChild(newBreadcrumbs, currentBreadcrumbs);
		}

		//Bind event to favorite buttons
		if(document.getElementsByClassName("favorite-button").length > 0){
			(function(){
				var buttons = document.getElementsByClassName('favorite-button');
				var i = 0;
				
				for(i = 0; i < buttons.length; i++){
					new lxt.ui.favorite(buttons[i]);
				}
			})();
		}

		sort();
	};

	//show/hide clear filters button
	var toggleClearFiltersButton = function(filters){
		var clear = document.getElementsByClassName('clear-filters');
		var i = 0;
		var quantity = clear.length;

		for(i = 0; i < quantity; i++){
			if(Object.keys(filters).length > 0){
				clear[i].style.display = 'inherit';
			}else{
				clear[i].style.display = 'none';
			}
		}
	};

	var clear = function(){
		[].forEach.call(document.querySelectorAll('.filters li'), function(element, index, array){
			element.classList.remove('active');
		});

		[].forEach.call(document.querySelectorAll(".min-size, .max-size, .min-price, .max-price"), function(element, index, array){
			element.getElementsByTagName("option")[0].selected = true;
		});

		[].forEach.call(document.querySelectorAll(".filter-location"), function(element, index, array){
			element.remove();
		});

		processFilters();
		
		document.querySelector("label[for=filter-search]").style.display = 'block';
	};

	var sort = function(){
		if(document.getElementsByClassName('sort-by').length > 0){
			new lxt.ui.dropdown(document.getElementsByClassName('sort-by')[0]);
		}
	}

	//Initial filter process
	buildFilterObject();

	return {
		filtered: filtered,
		isAutomatic: isAutomatic,
		processFilters: processFilters,
		clear: clear,
		sort: sort
	}
};
lxt.form.enquiry = function(options){
	'use strict';

	var id = "enquiry-"+(new Date().getTime());

	var init = function(){
		var defaults = {
			url: lxt.root + "form/",
			auto: false,
			formData: {},
			triggerClass: 'open-enquiry',
			size: 'large', 
			callbackFn: null
		};

		//Extend defaults
		options = lxt.extend(defaults, options);
		
		//We are gonna move this to wherever we need it and not do it by default
		//Add current url to formData
		var current_url = window.location.href.split("?")
		current_url = current_url[0];
		options.formData.url = current_url;
		var urlParameters = lxt.getUrlParameters();
		//If there is a defined agent (param) we will add it to formData
		if(typeof urlParameters.agent !== "undefined" && urlParameters.agent !== null){
			options.formData.agent = urlParameters.agent;
		}

		lxt.ajax({
			url: options.url, 
			formData: options.formData,
			callbackFn: function(data){
	  			var form = document.createElement("div");

				//Form & data
				form.id = id;
				form.innerHTML = data;

				//Append to document body
				document.body.appendChild(form);

	  			new lxt.ui.modal(
					form,
					{ 
						openClass : options.triggerClass,
						size: options.size,
						auto: options.auto,
						title: (document.getElementById('enquiry-form')) ? document.getElementById('enquiry-form').dataset.title : '',
						subtitle: (document.getElementById('enquiry-form')) ? document.getElementById('enquiry-form').dataset.subtitle : ''
					}
				);

				//Country selectors			
				(function(){
					var phones = form.getElementsByClassName("phone-selector");

					for(var i = 0; i < phones.length; i++){
						lxt.ui.countrySelector(phones[i]);
					}
				})();

				//If callback defined exec
				if(typeof options.callbackFn === "function"){
					options.callbackFn();
				}
	  		}
		});
	};

	var remove = function(){
		document.getElementById(id).remove();
	};

	init();

	return {
		remove: remove
	};
};
lxt.form.saveSearch = function(){
	'use strict';
	
	lxt.ajax({
		url: lxt.root+"my-searches/form/",
		callbackFn: function(data){
	  		var modalContent = document.createElement("div");
	  		var form;
	  		var saveSearchForm;

	  		modalContent.innerHTML = data;
	  		document.getElementsByTagName("body")[0].appendChild(modalContent);
	  		
	  		saveSearchForm = new lxt.ui.modal(
				modalContent,
				{ 
					animationSpeed: 200,
					size: 'small',
					auto: true,
					title: document.getElementById('save-search-form').dataset.title, 
					subtitle: document.getElementById('save-search-form').dataset.subtitle,
					onOpen: function(){
						//Get the form
	  					form = document.getElementById('save-search-form');
	  		
						if(form){
							var urlField = document.createElement("input");
							urlField.type = "hidden";
					  		urlField.name = "url";
					  		urlField.value = encodeURIComponent(window.location.href.replace(/\#/g, ''));
					  		form.appendChild(urlField);

					  		form.addEventListener('submit', function(e){
					  			var container = form.parentNode;
					  			var containerHeight = container.clientHeight;
					  			var formData = {};
					  			var fields = form.querySelectorAll('input, select');

					  			e.preventDefault();

					  			//Set up a saving message while processing
					  			container.style.display = 'table';
					  			container.innerHTML = '<div style="display:table-cell; vertical-align:middle; text-align:center; height:'+containerHeight+'px; width:100%;"><p class="tw">' + L.user.saving + '</p></div>';

					  			//Get form data
					  			Object.keys(fields).map(function(key){
									formData[fields[key].name] = fields[key].value;
								});

					  			lxt.ajax({
					  				url: form.action,
					  				formData: formData,
					  				callbackFn: function(data){
					  					switch(data){
				  							case "ok":
				  								saveSearchForm.close();
				  								lxt.ui.message(L.user.search_saved);
				  								break;

				  							case "ko":
				  								saveSearchForm.close();
				  								lxt.ui.message(L.default_error);
				  								break;

				  							case "login":
				  								var button = document.createElement('a');
				  								button.classList.add('btn');
				  								button.classList.add('btn-white');
				  								button.innerText = L.continue;

				  								container.getElementsByTagName('p')[0].innerText = L.user.search_login;
				  								container.getElementsByTagName('div')[0].appendChild(button);

				  								button.addEventListener('click', function(){
				  									saveSearchForm.close();
				  									setTimeout(function(){ document.getElementsByClassName('login-button')[0].click(); }, 500);
				  								});
				  								break;
				  						}
					  				}
					  			});
					  		});
					  	}
					},
					onClose: function(){
						form.remove();
						saveSearchForm = null;
					}
				}
			);

		}
	});
};
lxt.form.settings = function(options){
	'use strict';

	var init = function(){
		var defaults = {
			url: lxt.root+"settings/",
			auto: false,
			formData: {},
			triggerClass: 'settings-trigger',
			size: 'xsmall', 
			callbackFn: null
		};

		options = lxt.extend(defaults, options);

		options.formData.url = window.location.href;
		
		lxt.ajax({
			url: options.url, 
			formData: options.formData,
			callbackFn: function(data){
				var form = document.createElement("div");
				
				form.id = "settings";
				form.innerHTML = data;

				document.body.appendChild(form);

	  			new lxt.ui.modal(
					form,
					{ 
						openClass : options.triggerClass,
						size: options.size, 
						auto: options.auto,
						title: (document.getElementById('settings-form')) ? document.getElementById('settings-form').dataset.title : '',
						subtitle: (document.getElementById('settings-form')) ? document.getElementById('settings-form').dataset.subtitle : ''
					}
				);
			}
		});
	};

	init();

	return {};
};
lxt.form.signUp = function(options){
	'use strict';
	
	var init = function(){
		var defaults = {
			auto: false,
			size: "small",
			triggerClass: "login-button"
		}

		options = lxt.extend(defaults, options);

		lxt.ajax({
			url: lxt.root+"login/",
			formData: {
				url: window.location.href
			},
			callbackFn: function(data){
				var form = document.createElement("div"),
	  				urlField = document.createElement("input"),
	  				currentForm = document.getElementById("login-form");
				
				if(currentForm !== null){
					currentForm.remove();
				}

				form.id = "login-form";
				form.innerHTML = data;

				urlField.type = "hidden";
				urlField.name = "url";
				urlField.value = window.location.href;
				form.getElementsByTagName("form")[0].appendChild(urlField);

				document.getElementById("content").appendChild(form);

	  			new lxt.ui.modal(
					form,
					{ 
						auto: options.auto,
						animationSpeed: 200,
						openClass : options.triggerClass,
						size: options.size,
						title: L.welcome,
						subtitle: L.user.login_or_signup,
						onClose: function(){
							form.getElementsByClassName('login')[0].click();
						} 
					}
				);

				[].forEach.call(form.getElementsByClassName('signup-field'), function(element){
					element.classList.add("hidden");
					[].forEach.call(element.querySelectorAll('input, select, textarea'), function(input){
						input.disabled = true;
					});
				});

				form.getElementsByClassName('login')[0].addEventListener("click", function(){
					if(!this.classList.contains('btn-white')){
						this.classList.add('btn-white');
						form.getElementsByClassName('signup')[0].classList.remove('btn-white');
						form.getElementsByClassName('submit')[0].innerText = "Login";

						[].forEach.call(form.getElementsByClassName('signup-field'), function(element){
							element.classList.add("hidden");
							[].forEach.call(element.querySelectorAll('input, select, textarea'), function(input){
								input.disabled = true;
							});
						});

						[].forEach.call(form.getElementsByClassName('login-field'), function(element){
							element.classList.remove("hidden");
							[].forEach.call(element.querySelectorAll('input, select, textarea'), function(input){
								input.disabled = false;
							});
						});
					}
				});

				form.getElementsByClassName('signup')[0].addEventListener("click", function(){
					if(!this.classList.contains('btn-white')){
						this.classList.add('btn-white');
						form.getElementsByClassName('login')[0].classList.remove('btn-white');
						form.getElementsByClassName('submit')[0].innerText = L.user.signup;

						[].forEach.call(form.getElementsByClassName('signup-field'), function(element){
							element.classList.remove("hidden");
							[].forEach.call(element.querySelectorAll('input, select, textarea'), function(input){
								input.disabled = false;
							});
						});

						[].forEach.call(form.getElementsByClassName('login-field'), function(element){
							element.classList.add("hidden");
							[].forEach.call(element.querySelectorAll('input, select, textarea'), function(input){
								input.disabled = true;
							});
						});
					}
				});
			}
		});
	};

	init();

	return {};
};
(function(){
  'use strict';

  var _this = this;
  
  _this.setMap = function(id, landmarks){
    _this.canvas = document.getElementById(id);
    _this.mapJSON = lxt.root + "script/dist/places.js";
    _this.infoWindow = false;
    _this.landmarks = landmarks;
    _this.options = {
      center: { lat: parseFloat(_this.canvas.dataset.lat), lng: parseFloat(_this.canvas.dataset.lng) },
      zoom: parseInt(_this.canvas.dataset.zoom),
      mapTypeId: google.maps.MapTypeId.ROADMAP,
      zoomControl: false,
      panControl: false,
      scaleControl: false,
      mapTypeControl: false,
      streetViewControl: false
    }

    _this.init();
  };

  _this.init = function(){
    if(typeof google === 'undefined'){
      throw 'Google Maps is required';
    }

    _this.map = new google.maps.Map(_this.canvas, _this.options);
    _this.canvas.parentNode.classList.add("loaded");
    
    if(_this.landmarks){
      _this.canvas.after(_this.addIconDisclamer());
      
      if(typeof InfoBox === "function"){
        _this.infoWindow = new InfoBox({
          content: '',
          boxStyle: { 
            background: 'rgb(255, 255, 255)',
            opacity: 1,
            width: "280px"
          },
          closeBoxMargin: "0px 0px 0px 0px",
          closeBoxURL: lxt.root+"images/close.png",
          alignBottom: true,
          pixelOffset: new google.maps.Size(-140, -37)
        });
      }

      lxt.ajax({
        url: _this.mapJSON,
        callbackFn: function(data){
            if(data != ''){
                _this.landmarkObject = JSON.parse(data);
            }else{
                _this.landmarkObject = [];
            }
            
            _this.setLandmarks(_this.canvas.dataset.landmarks);
        }
      });
    }
  };

  _this.setLandmarks = function(landmarks){
    if(typeof landmarks !== 'undefined'){
      landmarks = landmarks.split('&');
                      
      for(var i = 0; i < landmarks.length; i++){
        if(typeof landmarks[i] !== 'undefined'){
          _this.checkLandmark(landmarks[i], function(place){
            if(place){
              if(place.type === 'polygon'){
                var max = place.path.length;
                var i = 0;
                var path = [];

                for(i = 0; i < max; i++){
                  path.push(new google.maps.LatLng(place.path[i]['lat'], place.path[i]['lng']));
                }

                _this.setPolygon({
                  type: 'polygon',
                  id: place.id,
                  title: place.title,
                  description: place.description,
                  link: place.link,
                  linkText: place.linkText,
                  path: path
                });  
              }else{
                _this.setMarker({
                  id: place.id,
                  title: place.title,
                  description: place.description,
                  link: place.link,
                  linkText: place.linkText,
                  category: place.category,
                  position: place.position
                });
              }
            }
          });
        }
      }
    }
  };

  _this.checkLandmark = function(id, callbackFn){
    var i = 0;

      if(_this.landmarkObject.length == 0){
          if(typeof callbackFn === 'function'){
              callbackFn(false);
          }
          return false; 
      }

      for(i = 0; i < _this.landmarkObject.length; i++){
          if(typeof _this.landmarkObject[i].id !== 'undefined' && _this.landmarkObject[i].id == id){
              if(typeof callbackFn === 'function'){
                  callbackFn(_this.landmarkObject[i]);
              }
              return _this.landmarkObject[i];
          }

          if(i == (_this.landmarkObject.length -1)){
              if(typeof callbackFn === 'function'){
                  callbackFn(false);
              }
              return false; 
          }
      }
  }

  _this.setMarker = function(place){
    var marker = new google.maps.Marker({
      position: new google.maps.LatLng(place.position.lat, place.position.lng),
      map: _this.map,
      type: 'marker',
      id: place.id,
      title: place.title,
      description: place.description, 
      link: place.link,
      linkText: place.linkText,
      category: place.category,
      visible: true
    });

    if(typeof place.category !== 'undefined' && place.category !== 'undefined'){
      marker.setIcon(lxt.root+'images/map-icons/low/'+place.category.replace(/ /g, '_').toLowerCase()+'.png');
    }

    if(_this.infoWindow){
      marker.addListener('mouseover', function(){
        //init content with the title
        var content = '<div style="padding:10px 27px 10px 10px;"><h1 style="font-family: Tw Cen MT; text-transform:uppercase; letter-spacing:1px; color:#000; font-size:14px; line-height:20px; font-weight:bold;">' + place.title + '</h1>';
        
        if(marker.description !== ''){
          content += '<div style="margin:10px 0px; font-size:12px; font-family:georgia; color:#333;">'+marker.description+'</div>';
        }

        if(marker.link !== ''){
          content += '<a style="font-family:georgia; font-size:12px; color:#333; text-decoration:underline; font-style:italic; display:block" href="'+marker.link+'" target="_blank">'+((typeof marker.linkText !== 'undefined' && marker.linkText !== '') ? marker.linkText : 'Read more')+'</a>';
        }
        content += '</div>';

        _this.infoWindow.close();
        _this.infoWindow.setContent(content);
        _this.infoWindow.open(_this.map, marker);
      });
    }
  }

  _this.setPolygon = function(place){
    var polygon = new google.maps.Polygon({
      paths: place.path,
      map: _this.map,
      type: 'polygon',
      id: place.id,
      title: place.title,
      description: place.description,
      link: place.link,
      linkText: place.linkText,
      visible: true,
      strokeColor: '#000000',
      strokeOpacity: 0.6,
      strokeWeight: 1,
      fillColor: '#000000',
      fillOpacity: 0.05
    });
  };

  _this.addIconDisclamer = function(){
    //Map credits
    var icon = document.createElement("a");
    var credits = document.createElement("div");

    //icon styles sand contents
    icon.classList.add('map-credits-icon');
    icon.appendChild(document.createElement("img"));
    icon.getElementsByTagName("img")[0].src = lxt.root+"images/infoIcon.png";
    
    //Credits styles and contents
    credits.classList.add('map-credits');
    credits.innerHTML = 'Icons made by <a href="http://www.flaticon.com/authors/scott-de-jonge" title="Scott de Jonge">Scott de Jonge</a>, <a href="http://www.freepik.com" title="Freepik">Freepik</a>, <a href="http://www.flaticon.com/authors/simpleicon" title="SimpleIcon">SimpleIcon</a>, <a href="http://www.flaticon.com/authors/yannick" title="Yannick">Yannick</a> and <a href="http://www.flaticon.com/authors/google" title="Google">Google</a> from <a href="http://www.flaticon.com" title="Flaticon">www.flaticon.com</a> is licensed by <a href="http://creativecommons.org/licenses/by/3.0/" title="Creative Commons BY 3.0">CC BY 3.0</a>';
    
    icon.appendChild(credits);

    return icon;
  };
}).apply(lxt.ui);

/*(function(){
  'use strict';

  var _this = this;

  _this.setMap = function(id){
    var mapObject = document.getElementById(id);
    var mapWrapper = document.createElement("div");
    var newMap;
    var infoWindow;
    var landmarks = (mapObject !== null && (typeof mapObject.dataset.landmarks !== 'undefined' && mapObject.dataset.landmarks !== '')) ? mapObject.dataset.landmarks.split('&') : [];

    var mapOptions = {
        center: { lat: parseFloat(mapObject.dataset.lat), lng: parseFloat(mapObject.dataset.lng) },
        zoom: parseInt(mapObject.dataset.zoom),
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        zoomControl: false,
        panControl: false,
        scaleControl: false,
        mapTypeControl: false,
        streetViewControl: false,
        styles: (typeof mapStyles !== "undefined") ? mapStyles : []
      };

    //Map wrapper
    if(!mapObject.parentNode.classList.contains("map-wrapper")){
      mapObject.parentNode.insertBefore(mapWrapper, mapObject);
      mapWrapper.classList.add("map-wrapper");
      mapWrapper.appendChild(mapObject);
      
    }else{
      mapWrapper = mapObject.parentNode;
    }

    mapWrapper.appendChild(_this.addIconDisclamer());

    //Start map
    newMap = new google.maps.Map(document.getElementById(id), mapOptions);
    
    if(typeof InfoBox === "function"){
      infoWindow = new InfoBox({
        content: '',
        boxStyle: { 
          background: 'rgb(255, 255, 255)',
          opacity: 1,
          width: "280px"
        },
        closeBoxMargin: "0px 0px 0px 0px",
        closeBoxURL: lxt.root+"images/close.png",
        alignBottom: true,
        pixelOffset: new google.maps.Size(-140, -37)
      });
    }

    
    lxt.ajax({
      url: lxt.root+"script/dist/places.js" + "?" + new Date().getTime(),
      callbackFn: function(data){
        var auxLandmarks = landmarks;

        if(data !== ''){
          var mapPlaces = JSON.parse(data);
          var i = 0;
          var j = 0;
          var placesQuantity = 0;
          var landmarksQuantity = 0;
          
          placesQuantity = mapPlaces.length;
          landmarksQuantity = landmarks.length;

          for(i = 0; i < placesQuantity; i++){
            for(j = 0; j < landmarksQuantity; j++){
              if(mapPlaces[i].id === landmarks[j]){
                auxLandmarks.splice(j, 1);

                switch(mapPlaces[i].type){
                  case 'marker':
                    _this.addMarker(mapPlaces[i], newMap, infoWindow);
                    break;

                  case 'polygon':
                    _this.addPolygon(mapPlaces[i], newMap, infoWindow);
                    break;
                }
              }
            }
          }
        }

        if(auxLandmarks.length > 0){
          //var geocoder = new google.maps.Geocoder();
          var service = new google.maps.places.PlacesService(newMap);

          for(i = 0; i < auxLandmarks.length; i++){
            service.getDetails({ placeId: auxLandmarks[i] }, function(result, status){
              if(status === "OK"){
                if(result){
                  var place = {
                    id: result.place_id,
                    position: { lat: result.geometry.location.lat(), lng: result.geometry.location.lng() },
                    description: result.formatted_address,
                    title: result.name,
                    link: '', //result.website,
                    linkText: L.read_more,
                    type: "marker",
                    category: lxt.capitalize(L.development.name)
                  }

                  _this.addMarker(place, newMap, infoWindow);
                }
              }
            });
          }
        }

        mapWrapper.classList.add("loaded");
      }
    });
  };

  _this.addMarker = function(place, map, infoWindow){
    
    var marker = new google.maps.Marker({
      position: new google.maps.LatLng(place.position.lat, place.position.lng),
      map: map,
      type: 'marker',
      id: place.id,
      title: place.title,
      description: place.description, 
      link: place.link,
      linkText: place.linkText,
      category: place.category,
      visible: true
    });

    if(typeof place.category !== 'undefined' && place.category !== 'undefined'){
      marker.setIcon(lxt.root+'images/map-icons/low/'+place.category.replace(/ /g, '_').toLowerCase()+'.png');
    }

    marker.addListener('mouseover', function(){
      //init content with the title
      var content = '<div style="padding:10px 27px 10px 10px;"><h1 style="font-family: Tw Cen MT; text-transform:uppercase; letter-spacing:1px; color:#000; font-size:14px; line-height:20px; font-weight:bold;">' + place.title + '</h1>';
      
      if(marker.description !== ''){
        content += '<div style="margin:10px 0px; font-size:12px; font-family:georgia; color:#333;">'+marker.description+'</div>';
      }

      if(marker.link !== ''){
        content += '<a style="font-family:georgia; font-size:12px; color:#333; text-decoration:underline; font-style:italic; display:block" href="'+marker.link+'" target="_blank">'+((typeof marker.linkText !== 'undefined' && marker.linkText !== '') ? marker.linkText : L.read_more)+'</a>';
      }
      content += '</div>';

      infoWindow.close();
      infoWindow.setContent(content);
      infoWindow.open(map, marker);
    });
  };

  _this.addPolygon = function(place, map, infoWindow){
    new google.maps.Polygon({
      paths: place.path,
      map: map,
      type: 'polygon',
      id: place.id,
      title: place.title,
      description: place.description,
      link: place.link,
      linkText: place.linkText,
      visible: true,
      strokeColor: '#000000',
      strokeOpacity: 0.6,
      strokeWeight: 1,
      fillColor: '#000000',
      fillOpacity: 0.05
    });
  };

  _this.addIconDisclamer = function(){
    //Map credits
    var icon = document.createElement("a");
    var credits = document.createElement("div");

    //icon styles sand contents
    icon.classList.add('map-credits-icon');
    icon.appendChild(document.createElement("img"));
    icon.getElementsByTagName("img")[0].src = lxt.root+"images/infoIcon.png";
    
    //Credits styles and contents
    credits.classList.add('map-credits');
    credits.innerHTML = 'Icons made by <a href="http://www.flaticon.com/authors/scott-de-jonge" title="Scott de Jonge">Scott de Jonge</a>, <a href="http://www.freepik.com" title="Freepik">Freepik</a>, <a href="http://www.flaticon.com/authors/simpleicon" title="SimpleIcon">SimpleIcon</a>, <a href="http://www.flaticon.com/authors/yannick" title="Yannick">Yannick</a> and <a href="http://www.flaticon.com/authors/google" title="Google">Google</a> from <a href="http://www.flaticon.com" title="Flaticon">www.flaticon.com</a> is licensed by <a href="http://creativecommons.org/licenses/by/3.0/" title="Creative Commons BY 3.0">CC BY 3.0</a>';
    
    icon.appendChild(credits);

    return icon;
  };
}).apply(lxt.ui);
*/
lxt.touch = function(){
	'use strict';

	var menuTrigger = document.getElementsByClassName("menu-trigger");
	var menuItems = document.querySelectorAll(".menu > ul > li > .menu-item");
	var menuGoBack = document.getElementsByClassName("close");
	var mainMenu = document.getElementById("main-menu");
	var menuBg = document.getElementsByClassName('menu-bg')[0];
	var i;
	
	//Menu trigger
	for(i = 0; i < menuTrigger.length; i++){
		menuTrigger[i].addEventListener("click", function(e){
			e.preventDefault();
			if(mainMenu.classList.contains('active')){
				mainMenu.classList.remove('active');
				menuBg.classList.remove('active');
			}else{
				mainMenu.classList.add('active');
				menuBg.classList.add('active');
			}
		});
	}

	//Submenus
	for(i = 0; i < menuItems.length; i++){
		if(menuItems[i].parentNode.getElementsByClassName("submenu") !== null && menuItems[i].parentNode.getElementsByClassName("submenu").length > 0){
			menuItems[i].addEventListener("click", function(e){
				e.preventDefault();
				this.parentElement.getElementsByClassName("submenu")[0].classList.toggle("active");
			});
		}
	}

	//Go back buttons
	for(i = 0; i < menuGoBack.length; i++){
		menuGoBack[i].addEventListener("click", function(e){
			e.preventDefault();

			if(lxt.getParent(this, ".submenu")){
				lxt.getParent(this, ".submenu").classList.remove("active");
			}else{
				lxt.getParent(this, ".menu").classList.remove("active");
				menuBg.classList.remove('active');
			}
		});
	}

	//Bg click
	menuBg.addEventListener('click', function(){
		var menus = document.querySelectorAll('.submenu.active, .menu.active');
		var i = 0;
		var quantity = menus.length;

		menuBg.classList.remove('active');

		for(i = 0; i < quantity; i++){
			menus[i].classList.remove('active');
		}
	});

	document.addEventListener('touchstart', ontouchstart, {passive: true});
};
lxt.ui.countrySelector = function(element){
	'use strict';

	var typedCharacters = "";

	var init =  function(){
		bindCountryToggle();
		bindOptionClick();
		bindCountryCode();
		bindKeyboardInput();
	};

	var bindCountryToggle = function(){
		//Toggle country code selector
		element.addEventListener('click', function(e){
			if(e.target.classList.contains('current-selection') || lxt.getParent(e.target, '.current-selection')){
				e.stopPropagation();

				lxt.toggle(element.getElementsByClassName('options-selector')[0]);
			}
		});
		
		//On click outside the country selector hide it
		document.body.addEventListener("click", function(){
			element.getElementsByClassName("options-selector")[0].style.display = "none";			
		});
	};

	var bindCountryCode =  function(){
		//Avoid click on country code input
		element.getElementsByClassName("country-blocker")[0].addEventListener("click", function(e){
			e.stopPropagation();
			lxt.getParent(this, ".phone-selector").getElementsByClassName("country-selector")[0].click();
		});

		//Avoid focus on country code input
		element.getElementsByClassName("country-code")[0].addEventListener("focus", function(){
			lxt.getParent(this, ".phone-selector").getElementsByClassName("country-phone-number")[0].focus();
		});
	};
	
	var bindOptionClick = function(){
		var options = element.getElementsByClassName("country-option");

		for(var i = 0; i < options.length;  i++){
			//Select country code
			options[i].addEventListener("click", function(e){
				var selected = this;
				var value = selected.dataset.code;
				var id = selected.dataset.id;
				var flag = element.getElementsByClassName("country-flag")[0];
				var newFlag = selected.getElementsByClassName("country-flag")[0].cloneNode(true);

				e.preventDefault();
				document.getElementById("country").value = id;
				element.getElementsByClassName("country-code")[0].value = value;
				element.getElementsByClassName("country-phone-number")[0].focus();
				lxt.getParent(selected, '.options-selector').display = "none";
				flag.parentNode.replaceChild(newFlag, flag);
			});

			//Country over/selection
			options[i].addEventListener("mouseover", function(){
				for(var j = 0; j < options.length;  j++){
					options[j].classList.remove("selected");
				}
				
				this.classList.add("selected");
			});
		}
	};

	var bindKeyboardInput = function(){

		//key control
		element.getElementsByClassName("country-selector")[0].addEventListener("keydown", function(e){
			if(e.keyCode === 38 || e.keyCode === 40){
				e.preventDefault();
				return false;
			}
		});
		element.getElementsByClassName("country-selector")[0].addEventListener("keyup", function(e){
			var optionSelector = this.getElementsByClassName("options-selector")[0];
			var optionSelectorTop = optionSelector.getBoundingClientRect().top;
			var optionSelectorHeight = optionSelector.offsetHeight;
			var options = element.getElementsByClassName("country-option");
			var selected = optionSelector.getElementsByClassName("selected")[0] || null;
			var selectionTop = (selected !== null) ? selected.getBoundingClientRect().top : null;

			if(window.getComputedStyle(optionSelector, null).getPropertyValue("display") !== "none"){
				if(e.keyCode == 13){ //enter
					if(optionSelector.getElementsByClassName("selected").length === 1){
						optionSelector.getElementsByClassName("selected")[0].click();
					}
				}else if(e.keyCode == 38){ //up
					if(selected === null){
						optionSelector.querySelector(".country-option:last-child").classList.add("selected");
					}else{
						if(selected.previousElementSibling !== null){
							selected.previousElementSibling.classList.add("selected");
							selected.classList.remove("selected");
						}
					}
				}else if(e.keyCode == 40){ //down
					if(selected === null){
						optionSelector.querySelector(".country-option:first-child").classList.add("selected");
					}else{
						if(selected.nextElementSibling !== null){
							selected.nextElementSibling.classList.add("selected");
							selected.classList.remove("selected");
						}
					}
				}else{
					if(typedCharacters === ""){
						setTimeout(function(){
							typedCharacters = "";
						}, 600);
					}

					typedCharacters += String.fromCharCode(e.keyCode);
					selected = null;

					for(var i = 0; i < options.length; i++){
						options[i].classList.remove("selected");
						if(options[i].getElementsByClassName("country-name")[0].innerText.match(RegExp("^"+typedCharacters, "gi")) && selected === null){
							options[i].classList.add("selected");
							selected = options[i];
						}
					}
				}

				//Retrieve the current selected item again
				selected = optionSelector.getElementsByClassName("selected")[0] || null;
				if(selected !== null){
					selectionTop = selected.getBoundingClientRect().top;
					if(selectionTop < optionSelectorTop || selectionTop > optionSelectorHeight){
						optionSelector.scrollTop = optionSelector.scrollTop + selectionTop - optionSelectorTop;
					}
				}
			}
		});
	};

	init();
};
lxt.ui.dropdown = function(menu){
	'use strict';

	var init = function(){
		menu.addEventListener('click', function(e){
			if(!e.target.classList.contains('submenu') && !lxt.getParent(e.target, '.submenu')){
				menu.classList.toggle('active');
			}
		});

		document.addEventListener('click', function(e){
			if(e.target !== menu && !lxt.getParent(e.target, menu)){
				menu.classList.remove('active');
			}
		});
	};

	init();
};
lxt.ui.expandablePanel = function(options){
	'use strict';

	var defaults = {
		triggerClass: 'collapsed-text-trigger',
		panelClass: 'collapsed-text',
		expanded: false,
		expandedText: L.show_less,
		collapsedText: L.show_more
	};

	var init = function(){
		var triggers;
		var panel;
		var i;

		options = lxt.extend(defaults, options); 
		triggers = document.getElementsByClassName(options.triggerClass);

		for(i = 0; i < triggers.length; i++){
			//Get panel element
			panel = triggers[i].parentNode.getElementsByClassName(options.panelClass)[0];

			//Initial state
			if(options.expanded){
				triggers[i].innerText = options.expandedText;
				panel.classList.add("opened");
			}else{
				triggers[i].innerText = options.collapsedText;
				panel.classList.remove("opened");
			}

			//Add trigger click event
			triggers[i].addEventListener("click", function(){
				this.parentNode.getElementsByClassName(options.panelClass)[0].classList.toggle("opened");
				this.innerText = (this.innerText.toLowerCase() === options.expandedText.toLowerCase()) ? options.collapsedText : options.expandedText;
			});
		}
	};

	init();
};
lxt.ui.favorite = function(button){
	'use strict';

	button.addEventListener("click", function(e){
		e.stopPropagation();
		e.preventDefault();
		
		var _this = this;
		lxt.ajax({
			url: lxt.root+"my-collection/toggle/",
			formData: {
				id: _this.dataset.id
			}, 
			callbackFn: function(data){
				if(data === "add"){
		  			_this.classList.add("active");
		  			_this.classList.add("animate");
		  		}else{
		  			_this.classList.remove("active");
		  			_this.classList.remove("animate");
		  		}
			}
		});
	});
};
lxt.ui.filterItem = function(filterItem){
	'use strict';

	var observers;

	var init = function(){
		observers = new lxt.observerList();

		switch(filterItem.nodeName){
			case 'SELECT':
				addChangeEvent();
				break;

			case 'LI':
				addClickEvent();
				break;

			default:
				throw 'Not able to bind this item'; 
		}
	};

	var addClickEvent = function(){
		filterItem.addEventListener('click', function(e){
			e.stopPropagation();
		    e.preventDefault();

			var parent = lxt.getParent(this, ".filter-item");
			if((parent && parent.querySelector("#filter-search") === null) || !parent){

				//Operation acts like a radio button
				if(lxt.getParent(this, ".operation")){
					[].forEach.call(lxt.getParent(this, ".operation").getElementsByTagName("li"), function(element){
						element.classList.remove("active");
					})
				}

				//Activate the clicked option
				this.classList.toggle("active");
			}

			notify();				
		});
	};

	var addChangeEvent = function(){
		filterItem.addEventListener("change", function(){
			notify();
		});
	};

	var addObserver = function(data){
		observers.add(data);
	};

	var notify = function(){
		var tempObserver;

		for(var i = 0; i < observers.count(); i++){
			tempObserver = observers.get(i);

			if(typeof tempObserver === 'function'){
				tempObserver(this);
			}
		}
	};

	init();

	return {
		addObserver: addObserver,
		notify: notify
	}
};
lxt.ui.filterLabel = function(filterItem, options){
	'use strict';

	var filterName;
	var filterOptions;
	var defaultLabel;
	var updateFunction;
	var sufix = null;

	var defaults = {
		defaultLabel: true
	};

	var init = function(){
		var regEx = /(size|price)+/gi;

		options = lxt.extend(defaults, options);
		
		//List of checkboxes
		if(filterItem.getElementsByTagName("label").length > 0){
			//Filter options are from filter item
			filterOptions = filterItem;
			//Filter name
			filterName = filterOptions.getElementsByTagName("label")[0].dataset.rel;
			//Function that would be executed to create the new label
			updateFunction = buildListLabel;

			addOptionClickListener();
		//Range selectors			
		}else if(filterItem.getElementsByTagName("select").length > 0){
			//Filter options are from filter item
			filterOptions = filterItem;
			//Filter name
			filterName = regEx.exec(filterOptions.getElementsByTagName("select")[0].className)[0];
			//Function that would be executed to create the new label
			updateFunction = buildRangeLabel;

			addSelectChangeListener();
		//This is used for mobile
		}else if(lxt.getParent(filterItem, '#filter-modal')){
			//Filter options are from filter item
			filterOptions = document.querySelector('.filter-tab.'+filterItem.dataset.rel);
			
			//Check type
			if(filterOptions.getElementsByTagName("label").length > 0){
				//Filter name
				filterName = filterOptions.getElementsByTagName("label")[0].dataset.rel;
				//Function that would be executed to create the new label
				updateFunction = buildListLabel;
			}else if(filterOptions.getElementsByTagName("select").length > 0){
				//Filter name
				filterName = regEx.exec(filterOptions.getElementsByTagName("select")[0].className)[0];
				//Function that would be executed to create the new label
				updateFunction = buildRangeLabel;
			}else{
				throw "Not valid filter";	
			}
			
			if(updateFunction){
				addSelectChangeListener();
			}
		}else{
			throw "Not valid filter";
		}

		getDefaultLabel();
		update();
	};

	var update = function(){
		var newLabel;
		var label = filterItem.querySelector('.title');

		if(updateFunction){
			newLabel = updateFunction();

			if(newLabel){
				newLabel = lxt.capitalize(newLabel);
				if(newLabel.toLowerCase().trim() == L.types.studio){
					label.innerText = newLabel; //we don't want the 'beds' sufix only on this case
				}else{
					label.innerText = newLabel + ((sufix !== null) ? (' ' + sufix) : '');
				}
			}else{
				label.innerText = defaultLabel;
			}
		}
	};

	var getDefaultLabel = function(){
		var defaultLabels = {
			city: lxt.capitalize(L.city), 
			status: lxt.capitalize(L.filters.construction_status),
			type: lxt.capitalize(L.type), 
			size: lxt.capitalize(L.size), 
			bedrooms: lxt.capitalize(L.beds), 
			price: lxt.capitalize(L.price), 
			rental_period : lxt.capitalize(L.filters.rental_period), 
			operation : lxt.capitalize(L.for_sale)
		};

		var defaultSufix = {
			status: lxt.capitalize(L.types.properties),
			city: "", 
			type: "", 
			size: lxt.units, 
			bedrooms: lxt.capitalize(L.bedrooms_alt), 
			price: lxt.currency, 
			rental_period : "", 
			operation : ""	
		};

		if(options.defaultLabel){
			defaultLabel = defaultLabels[filterName];	
		}else{
			defaultLabel = '';
		}
		
		sufix = defaultSufix[filterName];
	};

	var buildRangeLabel = function(){
		var range = {
			min: formatNumber(filterOptions.querySelector('select[class*=min-]').value),
			max: formatNumber(filterOptions.querySelector('select[class*=max-]').value)
		};

		if(range.min !== 'default'){
			if(range.max !== 'default'){
				return L.filters.between_min_and_max.replace('{min}', range.min).replace('{max}', range.max);
			}else{
				return L.filters.bigger_than_min.replace('{min}', range.min);
			}
		}else if(range.max !== 'default'){
			return L.filters.smaller_than_max.replace('{max}', range.max);
		}
		
		return false;
	};

	var buildListLabel = function(){
		var list = filterOptions.querySelectorAll(".active > label");
		
		return Object.keys(list).map(function(i){
			return list[i].innerText.toLowerCase().replace(L.bedrooms, '').replace(/(<([^>]+)>)/ig,"").trim(); //replace all tags, then trim
		}).join(', ').replace(/,\s([^,]+)$/, ' ' + L.filters.or + ' $1'); //Replace last COMA with OR
	};

	var addSelectChangeListener = function(){
		var options = filterOptions.querySelectorAll("select");
		var i = 0;

		for(i = 0; i < options.length; i++){
			options[i].addEventListener('change', function(){
				update();
			});
		}
	};

	var addOptionClickListener = function(){
		var options = filterOptions.querySelectorAll("li");
		var i = 0;

		for(i = 0; i < options.length; i++){
			options[i].addEventListener('click', function(){
				setTimeout(function(){
					update();
				}, 500);
			});
		}
	};

	var formatNumber =  function(number){
		if(isNaN(number)){
			return number;
		}

		if(number >= 1000000){
			return (number / 1000000).toFixed(0) + 'm';
		}

		return lxt.numberWithCommas(number);
	};
	
	init();

	return {
		update: update
	};
};
lxt.ui.inputAutoGrow = function(input, minCharacters){
	'use strict';

	input.style.width = minCharacters+"ch";
	input.style.boxSizing = "content-box";

	input.addEventListener("keyup", function(){
		var charLength = this.value.length + 1;
		this.style.width = (charLength > minCharacters) ? charLength+"ch" : minCharacters+"ch";
	});
};
lxt.ui.message = function(text){
	'use strict';

	var message = document.createElement("div");

	message.innerText = text;
	message.classList.add("user-message");
	document.querySelector('body').appendChild(message);

	setTimeout(function(){
		document.getElementsByClassName('user-message')[0].remove();
	}, 3000);
};
lxt.ui.modal = function(selector, options){
	'use strict';

	var defaults = {  
    	animation: 'fadeAndPop', //fadeAndPop, none
	    animationSpeed: 500, //how fast animtions are
	    closeBackground: true, //if you click background will modal close?
	    closeClass: 'close-modal', //the class of a button or element that will close an open modal
	    openClass: 'open-modal',
	    topOffset: 40,
	    size: 'large',
	    beforeOpen: '',
	    onOpen: '',
	    onClose: '',
	    auto: false, 
	    title: '',
	    subtitle: '',
	    light: false
	};

	var modal;
	var overlay = false;
	var locked = false;

	var init = function(){
		//Extend options
		options = options || {};
		options = lxt.extend(defaults, options);

		//If we are not using one of the animations (so far only fadeAndPop)
		if(options.animation !== 'fadeAndPop'){
			options.animationSpeed = 1; //We want the animation to be instantaneous
		}

		//Bind selector
		modal = bindObject(selector);
		//Setup modal
		setupModal();

		//Setup overlay
		if(options.size != 'full'){
			setupOverlay();
		}

		//Listeners
		bindListeners();

		if(options.auto){
			setTimeout(function(){
				openModal();
			}, 500);
		}
	};
	
	//Setup the modal object
	var setupModal = function(){
		var modalContent = document.createElement('div');
		var modalHeader = document.createElement('div');
		var closeCross = document.createElement('span');

		//Wrap content
		modalContent.innerHTML = modal.innerHTML; 
		modalContent.classList.add('modal-content');

		//Add a header
		modalHeader.classList.add('modal-header');
		if(options.title){
			var title = document.createElement('h2');
			title.innerText = options.title;
			
			if(!options.subtitle){
				title.style.marginBottom = '0px';
			}

			modalHeader.appendChild(title);
		}

		if(options.subtitle){
			var subtitle = document.createElement('p');
			subtitle.innerText = options.subtitle;
			modalHeader.appendChild(subtitle);
		}

		closeCross.classList.add('close');
		closeCross.classList.add(options.closeClass);
		closeCross.innerHTML = '<svg fill="#FFFFFF" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/><path d="M0 0h24v24H0z" fill="none"/></svg>';
		modalHeader.appendChild(closeCross);

		//Set modal contents
		modal.innerHTML = '';
		modal.appendChild(modalHeader);
		modal.appendChild(modalContent);

		//Add modal class
		modal.classList.add('lxt-modal');
		if(options.light){
			modal.classList.add('lxt-modal--light');
		}

		//Remove all possible classes affecting size
		modal.classList.remove('xsmall');
		modal.classList.remove('small');
		modal.classList.remove('medium');
		modal.classList.remove('large');
		modal.classList.remove('video'); //legacy
		modal.classList.remove('xlarge');
		modal.classList.remove('full');

		//Add defined size class
		modal.classList.add(options.size);
		//Define animation duration
		modal.style.transitionDuration = (options.duration / 1000)+'s';
	};

	//Setup the overlay object
	var setupOverlay = function(){
		var bg = document.getElementsByClassName('modal-overlay');

		//if there are no instances, create one
		if(bg.length === 0){
			var div = document.createElement('div');
			div.classList.add('modal-overlay');

			document.getElementsByTagName('body')[0].appendChild(div);

			bg = document.getElementsByClassName('modal-overlay');
		}
		//Remove other instances
		if(bg.length > 1){
			for(var i = 1; i < bg.length; i++){
				bg[i].remove();
			}
		}

		//Set the overlay object
		overlay = bg[0];
		//Define animation duration
		overlay.style.transitionDuration = (options.duration / 1000)+'s';
	};

	//Bind the modal object
	var bindObject = function(){
		if(typeof selector === 'string' && document.querySelector(selector)){
			return document.querySelector(selector);
		}else if(typeof selector === 'object'){
			return selector;
		}

		throw "You must pass a valid object or selector";
	};

	//Bind open and close listeners
	var bindListeners = function(){
		var i = 0;
		var closeTriggers = modal.getElementsByClassName(options.closeClass);
		var openTriggers = document.getElementsByClassName(options.openClass);
		
		//Open
		for(i = 0; i < openTriggers.length; i++){
			openTriggers[i].addEventListener('click', function(e){
				e.stopPropagation();
				e.preventDefault();
				openModal();
			});
		}

		//Close
		for(i = 0; i < closeTriggers.length; i++){
			closeTriggers[i].addEventListener('click', function(e){
				closeModal();
			});
		}

		//Overlay click
		if(overlay){
			overlay.addEventListener('click', function(){
				closeModal();
			});
		}
	};

	//Lock & unlock event functions
	//Event functions
	var lockModal = function(){
		locked = true;
	};

	var unlockModal =  function(){
		locked = false;
	};

	var openModal = function(){
		//Ignore if the modal is already opening/closing
		if(!locked){
			if(typeof options.beforeOpen === "function"){
					options.beforeOpen.call(this);
			}

			lockModal();
			
			if(options.size == 'full'){
				document.querySelector('body').classList.add('body--full-modal');
				modal.style.top = 0;
			}else{
				modal.style.top = options.topOffset + ((typeof window.scrollY !== 'undefined') ? window.scrollY : window.pageYOffset) + 'px';
			}
			
				

			//Open
			modal.classList.add('active');
			
			if(overlay){
				overlay.classList.add('active');
			}

			setTimeout(function(){
				unlockModal();

				if(typeof options.onOpen === "function"){
					options.onOpen.call(this);
				}
			},
			options.animationSpeed);
		}
	};

	var closeModal = function(){
		//Ignore if the modal is already opening/closing
		if(!locked){
			lockModal();

			//Close
			modal.classList.remove('active');
			
			if(overlay){
				overlay.classList.remove('active');
			}
			
			if(options.size == 'full'){
				document.querySelector('body').classList.remove('body--full-modal');
			}
			
			setTimeout(function(){
				unlockModal();

				if(typeof options.onClose === "function"){
					options.onClose.call(this);
				}

				modal.style.top = '-10000px';
			},
			options.animationSpeed);
		}
	};

	init();

	return {
		open: openModal,
		close: closeModal
	};
};
lxt.ui.protectImage = function(image, options){
	'use strict';

	var defaults = {
		image: 'blank.gif',
		text: L.image_coyright
	};

	var container = image.parentNode;
	var position = image.getBoundingClientRect();
	var zIndex = window.getComputedStyle(image, null).getPropertyValue("z-index");
	var protector;

	var init = function(){
		//Extend options
		options = lxt.extend(defaults, options);

		//Create protector layer
		protector = buildProtector();
		container.appendChild(protector);

		//Add personalized context menu
		protector.addEventListener("contextmenu", function(e){
			var menus = document.getElementsByClassName("image-protector-menu");
			var contextMenu;

			e.preventDefault();

			if(menus.length > 0){
				for(var i = 0; i < menus.length; i++){
					menus[i].remove();
				}
			}

			//Create new context menu
			contextMenu = buildContextMenu(e);
			document.body.appendChild(contextMenu);
		});

		//On click elsewhere remove the menu
		document.addEventListener("click", function(){
			var menus = document.getElementsByClassName("image-protector-menu");
			for(var i = 0; i < menus.length; i++){
				menus[i].remove();
			}
		});
	};

	var buildProtector = function(){
		var protectorNode = document.createElement("img");
		//Calculate zindex
		zIndex = (!isNaN(parseFloat(zIndex)) && isFinite(zIndex)) ? zIndex+1 : 998;

		//Get top/left properties
		if(window.getComputedStyle(container, null).getPropertyValue("position") == "relative" && typeof lxt.getParent(image, ".slides") !== "undefined"){
			position = {
				top: 0,
				left: 0
			};
		}
		
		protectorNode.style.width = image.offsetWidth + "px";
		protectorNode.style.height = image.offsetHeight + "px";
		protectorNode.style.border = "0px solid transparent";
		protectorNode.style.position = "absolute";
		protectorNode.style.top = position.top+"px";
		protectorNode.style.left = position.left+"px";
		protectorNode.style.zIndex = zIndex;
		protectorNode.src = options.image;

		return protectorNode;
	};

	var buildContextMenu = function(e){
		var contextMenu = document.createElement("div");

		contextMenu.classList.add("image-protector-menu");
		contextMenu.style.position = "absolute";
		contextMenu.style.top = e.pageY+"px";
		contextMenu.style.left = e.pageX+"px";
		contextMenu.style.background = "#000000";
		contextMenu.style.border = "1px solid #111";
		contextMenu.style.padding = "2px 4px";
		contextMenu.style.boxShadow = "0 0 5px -1px #000";
		contextMenu.style.fontFamily = "Tw Cen MT, sans-serif";
		contextMenu.style.fontSize = "12px";
		contextMenu.style.color = "#eeeeee";
		contextMenu.style.letterSpacing = "1px";
		contextMenu.style.textAlign = "left";
		contextMenu.style.zIndex = zIndex + 1;
		contextMenu.innerHTML = options.text;

		return contextMenu;
	};

	init();
};
lxt.ui.scaleVideo = function(video, container, ratio){
	'use strict';
	
	if(typeof video !== 'undefined' && video !== null && typeof container !== 'undefined' && container !== null){
		video.style.width = "100%";
		video.style.height = (container.offsetHeight / container.offsetWidth) * video.offsetWidth+"px";
		video.style.visibility = 'visible';
		
		video.removeAttribute('width');
		video.removeAttribute('height');

		ratio = (container.offsetHeight / container.offsetWidth);

		window.addEventListener('resize', function(){
			lxt.ui.scaleVideo(video, null, ratio);
		});
	}else if(typeof video !== 'undefined' && typeof video !== null && typeof ratio !== 'undefined' && typeof ratio !== null){
		video.style.height = (video.offsetWidth * ratio)+"px";
	}
};
lxt.ui.searchField = function(element, options){
	'use strict';

	var searchField;
	var locationData;
	var autocompleteObject;

	var defaults = {
		filtersObject: null
	};

	var init = function(){
		//Extend options
		options = lxt.extend(defaults, options);

		if(options.filtersObject === null){
			throw "A filter object is require";
		}

		//Bind element
		searchField = element;
		//Setup
		searchField.style.display = "inline-block";
		searchField.style.width = "30px";
		searchField.parentNode.style.cursor = "text";
		searchField.parentNode.style.whiteSpace = "initial";
		//The element must grow as we type
		lxt.ui.inputAutoGrow(searchField, 3);

		//Check for current selected locations
		if(searchField.parentNode.getElementsByClassName('hidden').length > 0){
			getLocations(function(){
				var urlParameters = lxt.getUrlParameters();
				var locations = searchField.parentNode.getElementsByClassName('hidden');
				var locationQuantity = locations.length;
				var i = 0;
				var newLocation;
/*
				//If there is no filtering we add the filters->location param
				if(locationQuantity > 0 && (typeof urlParameters.filters === null || typeof urlParameters.filters === "undefined")){
					if(urlParameters.length === 0){
						window.history.replaceState({},"", encodeURI(window.location.href+"?filters=location"));
					}else{
						window.history.replaceState({},"", encodeURI(window.location.href+"&filters=location"));
					}
				}
*/				
				//Add all locations that match the locations.json query result
				for(i = (locationQuantity -1); i >= 0; i--){
					newLocation = {};

					if(locations[i].dataset.id){
						newLocation.name = locations[i].dataset.id.trim();
					}

					if(locations[i].dataset.type){
						newLocation.type = locations[i].dataset.type.trim();
					}

					if(locations[i].dataset.url){
						newLocation.url = locations[i].dataset.url.trim();
					}

					newLocation = findLocation(newLocation);

					if(newLocation){
						addLocation(newLocation.name, newLocation.type);
					}

					locations[i].remove();
				}
				//Toggle label visibility
				toggleLabel();
			});
		}
		
		//On focus and blur toggle the label
		searchField.addEventListener("focus", function(){
			if(typeof locationData === 'undefined'){
				getLocations();
			}
			toggleLabel();
		});
		
		searchField.addEventListener("blur", function(){
			toggleLabel();
		});

		//When clicking on searchField's parent, focus on the searchbox
		searchField.parentNode.addEventListener("click", function(){
			searchField.focus();
		});

		//Detect text input
		bindTextInput();
	};

	//Show/hide the search field label
	var toggleLabel = function(){
		document.querySelector("label[for=filter-search]").style.display = (document.getElementsByClassName("filter-location").length > 0 || document.getElementById("filter-search") == document.activeElement || document.getElementById("filter-search").value !== "")?"none":"block";
	};

	var getLocations = function(callbackFn){
		//Get locations
		lxt.ajax({
			url: lxt.root + "filter-locations/",
			method: "GET",
			callbackFn: function(data){
				locationData = JSON.parse(data);

				if(typeof callbackFn === 'function'){
					callbackFn();
				}
				if(typeof autocompleteObject === 'undefined'){
					bindAutocomplete();
				}
			}
		});
	};

	var bindTextInput =  function(){
		searchField.addEventListener("keyup", function(e){
			var term = searchField.value;
			var newLocation;

			if(e.keyCode === 13){
				searchField.value = "";
		    	searchField.blur();

		    	if(!isNaN(term)){
		    		addLocation(term, "ref");
		    		options.filtersObject.processFilters();
		    	}else{
		    		newLocation = findLocation({ name: term });
		    		if(newLocation){
			    		addLocation(newLocation.name, newLocation.type);
			    		options.filtersObject.processFilters();
			    	}
		    	}

		    	toggleLabel();
			}
		});
	};

	//AutoComplete
	var bindAutocomplete = function(){
		autocompleteObject = new autoComplete({
		    selector: '#'+searchField.id,
		    minChars: 3,
		    source: function(term, response){
				var quantity = locationData.length;
				var data = [];
				var cleanTerm = term.toLowerCase().trim();

				for(let i = 0; i < quantity; i++){
					if(locationData[i].name.trim().toLowerCase().indexOf(cleanTerm) != -1){
						data.push(locationData[i].name);
					}
				}

				if(data.length === 0){
					data.push(L.filters.no_results_for_term.replace('{term}', term));
				}

				response(data);
		    },
		    onSelect: function(event, term){
		    	var location = findLocation({
					name: term
				});

		    	//If it's not already there
		    	if(document.querySelectorAll(".filter-location[data-id='"+location.name+"']").length === 0){
		    		//add new location
		    		addLocation(location.name, location.type);
		    		//Re-process filters
					options.filtersObject.processFilters();
		    	}

		    	//If we are on a small device 
		    	if(window.innerWidth < lxt.desktopWidth){
		    		//Blur off the search field
			    	setTimeout(function(){ searchField.blur(); }, 500);
			    }
			    
			    //Clean the search field
			    searchField.value = "";

			    //Toggle label visibility
				toggleLabel();
		    }
		});
	};

	//Find location on the location object
	var findLocation = function(location){
		var found = false;
		for(var i = 0; i < locationData.length; i++){
    		if(typeof location.name !== 'undefined' && locationData[i].name.toLowerCase().trim() === location.name.toLowerCase().trim()){
    			found = true;

    			if(typeof location.type !== 'undefined' && locationData[i].type.toLowerCase().trim() === location.type.toLowerCase().trim()){
	    			found = true;
	    		}else if(typeof location.type !== 'undefined'){
	    			found = false;
	    		}
    		}else if(typeof location.name !== 'undefined'){
    			found = false;
    		}

    		if(typeof location.url !== 'undefined' && locationData[i].friendly_url.toLowerCase().trim() === location.url.toLowerCase().trim()){
    			found = true;

    			if(typeof location.type !== 'undefined' && locationData[i].type.toLowerCase().trim() === location.type.toLowerCase().trim()){
	    			found = true;
	    		}else if(typeof location.type !== 'undefined'){
	    			found = false;
	    		}
    		}else if(typeof location.url !== 'undefined'){
    			found = false;
    		}

    		if(found){
	    		location.name = locationData[i].name.trim();
				location.type = locationData[i].type.trim();
				location.url = locationData[i].friendly_url.trim();
				break;
			}
    	}

    	if(found){
			return location;
		}else{
			return false;
		}
	};

	var addLocation = function(name, type){
		//Create a new location element
		var location = document.createElement("div");

		location.className = "filter-location";
		location.dataset.id = encodeURIComponent(name);
		location.dataset.type = type;
		location.innerText = name;
		location.title = L.filters.remove;

		//We insert it before the search field
		searchField.parentNode.insertBefore(location, searchField);

		//We add the remove trigger
		location.addEventListener("click", function(){
			removeLocation(this);
		});
	};

	var removeLocation = function(location){
		//Remove element
		location.remove();
		//Make searchField label visible if needed
		toggleLabel();
		//Re-process filters
		options.filtersObject.processFilters();
	};

	init();
};
lxt.ui.sliderMiddleContent = function(slider, addListener){
	'use strict';

	var slides = slider.getElementsByClassName("inner");
	var i = 0; 
	var height = 0;

	for(i = 0; i < slides.length; i++){
		slides[i].style.visibility = "hidden";
		slides[i].style.paddingTop = "0px";
	}

	height = slider.offsetHeight;
	
	for(i = 0; i < slides.length; i++){
		slides[i].style.paddingTop = ((height - slides[i].offsetHeight) / 2)+"px";
		slides[i].style.visibility = "visible";
	}		

	if(addListener){
		window.addEventListener("resize", function(){
			lxt.ui.sliderMiddleContent(slider, false);
		});
	}
};
lxt.ui.tabs = function(tabGroup, options){
	'use strict';

	var defaults = {
		triggerClass: 'tab-trigger',
		triggerActiveClass: 'selected',
		tabClass: 'tab', 
		tabActiveClass: 'active'
	};

	var triggers;
	var tabs;

	var init = function(){
		options = lxt.extend(defaults, options);
		
		triggers = tabGroup.getElementsByClassName(options.triggerClass);
		tabs = tabGroup.getElementsByClassName(options.tabClass);

		bindTriggerClick();
	};

	var bindTriggerClick = function(){
		var i = 0;
		var j = 0;

		for(i = 0; i < triggers.length; i++){
			triggers[i].addEventListener("click", function(){
				var trigger = this;
				var index = Array.prototype.slice.call(triggers).indexOf(trigger);
				
				for(j = 0; j < tabs.length; j++){
					if(j !== index){
						tabs[j].classList.remove(options.tabActiveClass);
					}else{
						tabs[j].classList.add(options.tabActiveClass);
					}
				}

				for(j = 0; j < triggers.length; j++){
					if(j ==index){
						triggers[j].classList.add(options.triggerActiveClass);
					}else{
						triggers[j].classList.remove(options.triggerActiveClass);
					}
				}
			});
		}
	}

	init();
};
lxt.ui.userMenu = function(){
	'use strict';

	var triggers = document.getElementsByClassName("user-trigger");
	var box = document.getElementsByClassName("user-menu")[0];
	var menu = document.getElementById("user-menu");
	var menuBg = document.getElementsByClassName('menu-bg')[0];

	if(document.getElementsByClassName('user-trigger').length > 0 && window.innerWidth > lxt.desktopWidth){
		document.getElementsByClassName('user-menu')[0].style.width = document.getElementsByClassName('user-trigger')[0].offsetWidth+"px";
	}

	if(box || menu){
		for(var i = 0; i < triggers.length; i++){
			triggers[i].addEventListener("click", function(e){
				e.preventDefault();

				if('ontouchstart' in window && window.innerWidth < lxt.desktopWidth){
					box.style.display = "block";
					if(menu.classList.contains('active')){
						menu.classList.remove('active');
						menuBg.classList.remove('active');
					}else{
						menu.classList.add('active');
						menuBg.classList.add('active');
					}
				}else{
					box.classList.toggle("active");
					this.classList.toggle("active");
				}
			});
		}

		//On click outside the menu deactivate all menus
		document.addEventListener("click", function(e){
			if(!e.target.classList.contains("user-menu") && !lxt.getParent(e.target, ".user-menu") && !e.target.classList.contains("user-trigger") && !lxt.getParent(e.target, ".user-trigger")){
				if(window.innerWidth < lxt.desktopWidth){
					menu.classList.remove("active");
				}else{
					box.classList.remove("active");
				}

				for(var i = 0; i < triggers.length; i++){
					triggers[i].classList.remove('active');
				}
			}
		});
	}
};
window.addEventListener("load", function(){
	'use strict';

	var settingsForm = null;
	var loginForm = null;
	
	if('ontouchstart' in window && window.innerWidth < lxt.desktopWidth){
		lxt.touch();
	}

	//set phone selectors
	(function(){
		var phones = document.getElementsByClassName('phone-selector');
		for(var i = 0; i < phones.length; i++){
			lxt.ui.countrySelector(phones[i]);
		}
	})();
	
	//protect images
	(function(){
		var copyrightedImages = document.getElementsByClassName('copyright');
		for(var i = 0; i < copyrightedImages.length; i++){
			lxt.ui.protectImage(copyrightedImages[i], { image : lxt.root+'images/blank.gif' });
		}
	})();
	
	//favorites
	if(document.getElementsByClassName("favorite-button").length > 0){
		(function(){
			var buttons = document.getElementsByClassName('favorite-button');
			var i = 0;
			
			for(i = 0; i < buttons.length; i++){
				new lxt.ui.favorite(buttons[i]);
			}
		})();
	}
	//Setttings
	(function(){
		let currencySelector = document.getElementById('settings-currency');
		if(currencySelector){
			currencySelector.addEventListener('change', function(){ //Currency
				document.getElementById('settings').submit();
			});
		}
	})();
	(function(){
		var sizes = document.querySelectorAll('#settings-sq-ft, #settings-sq-m');
		for(var i = 0; i < sizes.length; i++){
			if(sizes[i].checked === false){
				sizes[i].addEventListener('click', function(){
					document.getElementById('settings').submit();
				});
			}
		}
	})();
	//Login & user menu
	if(document.body.classList.contains('loggedin')){
		//Setup user menu
		lxt.ui.userMenu();
	}else{
		//Require signup form
		lxt.click("login-button", function(){
			if(loginForm){
				return;
			}else{
				loginForm = lxt.form.signUp({ auto: true });
			}
		});
	}
	//Language selector
	lxt.click("settings-trigger", function(){
		if(settingsForm){
			return;
		}else{
			settingsForm = lxt.form.settings({ auto: true });
		}
	});
	//Composer forms
	if(document.querySelectorAll(".open-composer-form").length > 0){
		(function(){
			let enquiryForm;

			lxt.click('open-composer-form', function(){
				var button = this;
				if(enquiryForm) enquiryForm.remove();

				enquiryForm = lxt.form.enquiry({
					url: lxt.root + "enquiries/form/",
					auto: true,
					size: "medium",
					formData: button.dataset
				});
			});
		})();
	};
	//form validation
	(function(){
		let forms = document.querySelectorAll('form');
		for(let i = 0; i < forms.length -1; i++){
			hyperform(forms[i]);
		}
	})();
	
	document.addEventListener('submit', function(e){
		if(e.target.tagName === "FORM"){
			var f = this;
			var btns = f.getElementsByClassName('btn');

			for(var i = 0; i < btns.length; i++){
				
				if(btns[i].tagName === "BUTTON" && btns[i].type === "submit"){
					btns[i].disabled = true;
					btns[i].innerText = L.form.sending;
				}
			}
		}
	});
	//Sort
	if(document.getElementsByClassName('sort-by').length > 0){
		(function(){
			var filtersObject = new lxt.filters();
			filtersObject.sort();
		})();
	}
	
	//Filters
	if(document.getElementsByClassName("filters").length > 0){
		//Filters
		(function(){
			var filtersObject = new lxt.filters();
			var searchField = document.getElementById('filter-search');
			var filterArray = [];
			var dropdowns = false;
			var filterModal = document.getElementById('filter-modal');
			var items;
			var item;

			var i = 0;
			var j = 0;

			if(window.innerWidth >= lxt.desktopWidth){
				dropdowns = document.getElementsByClassName("filters")[0].getElementsByClassName("expand-button");
			}else{ 
				dropdowns = filterModal.getElementsByClassName('filter-item');
			}

			if(searchField){
				searchField = new lxt.ui.searchField(searchField, {
					filtersObject: filtersObject
				});
			}

			//If we are in mobile we need to create a modal window for the filters
			if(window.innerWidth < lxt.desktopWidth && filterModal){
				//We set up the filters model
				new lxt.ui.modal(
					filterModal,
					{ 
						openClass : 'open-filters',
						size: 'small',
						title: L.filters.name, 
						onClose: function(){
							filterModal.getElementsByClassName('filter-trigger')[0].click();
						}
					}
				);
				//The modal content must not be hidden
				filterModal.classList.remove('hidden');

				//We use the tabs method to change between filters
				new lxt.ui.tabs(
					filterModal,
					{
						triggerClass: 'filter-trigger',
						tabClass: 'filter-tab'
					}
				);

				//We do a little trick to make the 'go back' buttons trigger the first tab
				(function(){
					var firstTabTrigger = filterModal.getElementsByClassName('filter-trigger')[0];
					var triggers = document.getElementsByClassName('filters-go-back');
					var i;

					for(i = 0; i < triggers.length; i++){
						triggers[i].addEventListener('click', function(){
							firstTabTrigger.click();
						});
					}
				})();
			}


			//Control filter labels and filter item clicks/changes
			for(i = 0; i < dropdowns.length; i++){
				//Desktop
				if(window.innerWidth >= lxt.desktopWidth){
					//They are dropdowns
					new lxt.ui.dropdown(dropdowns[i]);
					//Setup labels
					filterArray[i] = new lxt.ui.filterLabel(dropdowns[i]);
					//Items are childs of the dropdown
					items = dropdowns[i].querySelectorAll("li, select");
				//Mobile/Tablet
				}else{
					//Setup Labels
					filterArray[i] = new lxt.ui.filterLabel(dropdowns[i], { defaultLabel: false });
					//Items are in a separate div. Use filter type rel as and tab class as identifier
					items = document.querySelector('.filter-tab.' + dropdowns[i].dataset.rel).querySelectorAll("li, select");
				}
				
				//Add listeners & observers
				if(items.length > 0){
					for(j = 0; j < items.length; j++){
						item = new lxt.ui.filterItem(items[j]);
						item.addObserver(filtersObject.processFilters);
						item.addObserver(filterArray[i].update);
					}
				}
			}

			if(filtersObject.isAutomatic){
				//Save search
				var saveButtons = document.getElementsByClassName('save-search-button');
				var clearButtons = document.getElementsByClassName("clear-filters");

				if(saveButtons.length > 0){
					for(i = 0; i < saveButtons.length; i++){
						saveButtons[i].addEventListener("click", function(){
							lxt.form.saveSearch();
						});
					}
				}

				//Bottom promo
				window.addEventListener("scroll", function(){
					var bar = document.querySelector('.filter-alerts-bar');
					if(bar && !bar.classList.contains("active")){
						bar.classList.add("active");
					}
				});

				//Clear filters
				if(clearButtons.length > 0){
					for(i = 0; i < clearButtons.length; i++){
						clearButtons[i].addEventListener("click", function(e){
							var i = 0;
							e.preventDefault();
							filtersObject.clear();

							for(i = 0; i < filterArray.length; i++){
								filterArray[i].update();
							}
						});
					}
				}
			}
		})();
	}

	//Referrer tracking
	if(document.referrer.indexOf('luxhabitat') === -1){
		setTimeout(function(){
			lxt.ajax({
				url: lxt.root+"config/tracking.php",
				formData: {
					ajax_source: document.referrer
				}
			});
		}, 5000);
	}

	
	(function(){
		var items = document.querySelectorAll('#main-menu > ul > li');
		
		for(var i = 0; i < items.length; i++){
			items[i].addEventListener('mouseover', function(){
				var li = this;
				var submenu = li.querySelector('.submenu');
				
				if(submenu){
					document.getElementsByClassName('menu-bg')[0].classList.add('active');
				}
			});

			items[i].addEventListener('mouseout', function(){
				document.getElementsByClassName('menu-bg')[0].classList.remove('active');
			});
		}
	})();

	(function(){
		var items = document.querySelectorAll('.faq-item');
		if(items.length > 0){
			for(var i = 0; i < items.length; i++){
				items[i].querySelector('h3').addEventListener('click', function(){
					this.parentNode.classList.toggle('active');
				});
			}
		}
	})();
});
/*!
 * Glide.js v3.4.1
 * (c) 2013-2019 Jędrzej Chałubek <jedrzej.chalubek@gmail.com> (http://jedrzejchalubek.com/)
 * Released under the MIT License.
 */

(function (global, factory) {
  typeof exports === 'object' && typeof module !== 'undefined' ? module.exports = factory() :
  typeof define === 'function' && define.amd ? define(factory) :
  (global.Glide = factory());
}(this, (function () { 'use strict';

  var defaults = {
    /**
     * Type of the movement.
     *
     * Available types:
     * `slider` - Rewinds slider to the start/end when it reaches the first or last slide.
     * `carousel` - Changes slides without starting over when it reaches the first or last slide.
     *
     * @type {String}
     */
    type: 'slider',

    /**
     * Start at specific slide number defined with zero-based index.
     *
     * @type {Number}
     */
    startAt: 0,

    /**
     * A number of slides visible on the single viewport.
     *
     * @type {Number}
     */
    perView: 1,

    /**
     * Focus currently active slide at a specified position in the track.
     *
     * Available inputs:
     * `center` - Current slide will be always focused at the center of a track.
     * `0,1,2,3...` - Current slide will be focused on the specified zero-based index.
     *
     * @type {String|Number}
     */
    focusAt: 0,

    /**
     * A size of the gap added between slides.
     *
     * @type {Number}
     */
    gap: 10,

    /**
     * Change slides after a specified interval. Use `false` for turning off autoplay.
     *
     * @type {Number|Boolean}
     */
    autoplay: false,

    /**
     * Stop autoplay on mouseover event.
     *
     * @type {Boolean}
     */
    hoverpause: true,

    /**
     * Allow for changing slides with left and right keyboard arrows.
     *
     * @type {Boolean}
     */
    keyboard: true,

    /**
     * Stop running `perView` number of slides from the end. Use this
     * option if you don't want to have an empty space after
     * a slider. Works only with `slider` type and a
     * non-centered `focusAt` setting.
     *
     * @type {Boolean}
     */
    bound: false,

    /**
     * Minimal swipe distance needed to change the slide. Use `false` for turning off a swiping.
     *
     * @type {Number|Boolean}
     */
    swipeThreshold: 80,

    /**
     * Minimal mouse drag distance needed to change the slide. Use `false` for turning off a dragging.
     *
     * @type {Number|Boolean}
     */
    dragThreshold: 120,

    /**
     * A maximum number of slides to which movement will be made on swiping or dragging. Use `false` for unlimited.
     *
     * @type {Number|Boolean}
     */
    perTouch: false,

    /**
     * Moving distance ratio of the slides on a swiping and dragging.
     *
     * @type {Number}
     */
    touchRatio: 0.5,

    /**
     * Angle required to activate slides moving on swiping or dragging.
     *
     * @type {Number}
     */
    touchAngle: 45,

    /**
     * Duration of the animation in milliseconds.
     *
     * @type {Number}
     */
    animationDuration: 400,

    /**
     * Allows looping the `slider` type. Slider will rewind to the first/last slide when it's at the start/end.
     *
     * @type {Boolean}
     */
    rewind: true,

    /**
     * Duration of the rewinding animation of the `slider` type in milliseconds.
     *
     * @type {Number}
     */
    rewindDuration: 800,

    /**
     * Easing function for the animation.
     *
     * @type {String}
     */
    animationTimingFunc: 'cubic-bezier(.165, .840, .440, 1)',

    /**
     * Throttle costly events at most once per every wait milliseconds.
     *
     * @type {Number}
     */
    throttle: 10,

    /**
     * Moving direction mode.
     *
     * Available inputs:
     * - 'ltr' - left to right movement,
     * - 'rtl' - right to left movement.
     *
     * @type {String}
     */
    direction: 'ltr',

    /**
     * The distance value of the next and previous viewports which
     * have to peek in the current view. Accepts number and
     * pixels as a string. Left and right peeking can be
     * set up separately with a directions object.
     *
     * For example:
     * `100` - Peek 100px on the both sides.
     * { before: 100, after: 50 }` - Peek 100px on the left side and 50px on the right side.
     *
     * @type {Number|String|Object}
     */
    peek: 0,

    /**
     * Collection of options applied at specified media breakpoints.
     * For example: display two slides per view under 800px.
     * `{
     *   '800px': {
     *     perView: 2
     *   }
     * }`
     */
    breakpoints: {},

    /**
     * Collection of internally used HTML classes.
     *
     * @todo Refactor `slider` and `carousel` properties to single `type: { slider: '', carousel: '' }` object
     * @type {Object}
     */
    classes: {
      direction: {
        ltr: 'glide--ltr',
        rtl: 'glide--rtl'
      },
      slider: 'glide--slider',
      carousel: 'glide--carousel',
      swipeable: 'glide--swipeable',
      dragging: 'glide--dragging',
      cloneSlide: 'glide__slide--clone',
      activeNav: 'glide__bullet--active',
      activeSlide: 'glide__slide--active',
      disabledArrow: 'glide__arrow--disabled'
    }
  };

  /**
   * Outputs warning message to the bowser console.
   *
   * @param  {String} msg
   * @return {Void}
   */
  function warn(msg) {
    console.error("[Glide warn]: " + msg);
  }

  var _typeof = typeof Symbol === "function" && typeof Symbol.iterator === "symbol" ? function (obj) {
    return typeof obj;
  } : function (obj) {
    return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj;
  };

  var classCallCheck = function (instance, Constructor) {
    if (!(instance instanceof Constructor)) {
      throw new TypeError("Cannot call a class as a function");
    }
  };

  var createClass = function () {
    function defineProperties(target, props) {
      for (var i = 0; i < props.length; i++) {
        var descriptor = props[i];
        descriptor.enumerable = descriptor.enumerable || false;
        descriptor.configurable = true;
        if ("value" in descriptor) descriptor.writable = true;
        Object.defineProperty(target, descriptor.key, descriptor);
      }
    }

    return function (Constructor, protoProps, staticProps) {
      if (protoProps) defineProperties(Constructor.prototype, protoProps);
      if (staticProps) defineProperties(Constructor, staticProps);
      return Constructor;
    };
  }();

  var _extends = Object.assign || function (target) {
    for (var i = 1; i < arguments.length; i++) {
      var source = arguments[i];

      for (var key in source) {
        if (Object.prototype.hasOwnProperty.call(source, key)) {
          target[key] = source[key];
        }
      }
    }

    return target;
  };

  var get = function get(object, property, receiver) {
    if (object === null) object = Function.prototype;
    var desc = Object.getOwnPropertyDescriptor(object, property);

    if (desc === undefined) {
      var parent = Object.getPrototypeOf(object);

      if (parent === null) {
        return undefined;
      } else {
        return get(parent, property, receiver);
      }
    } else if ("value" in desc) {
      return desc.value;
    } else {
      var getter = desc.get;

      if (getter === undefined) {
        return undefined;
      }

      return getter.call(receiver);
    }
  };

  var inherits = function (subClass, superClass) {
    if (typeof superClass !== "function" && superClass !== null) {
      throw new TypeError("Super expression must either be null or a function, not " + typeof superClass);
    }

    subClass.prototype = Object.create(superClass && superClass.prototype, {
      constructor: {
        value: subClass,
        enumerable: false,
        writable: true,
        configurable: true
      }
    });
    if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass;
  };

  var possibleConstructorReturn = function (self, call) {
    if (!self) {
      throw new ReferenceError("this hasn't been initialised - super() hasn't been called");
    }

    return call && (typeof call === "object" || typeof call === "function") ? call : self;
  };

  /**
   * Converts value entered as number
   * or string to integer value.
   *
   * @param {String} value
   * @returns {Number}
   */
  function toInt(value) {
    return parseInt(value);
  }

  /**
   * Converts value entered as number
   * or string to flat value.
   *
   * @param {String} value
   * @returns {Number}
   */
  function toFloat(value) {
    return parseFloat(value);
  }

  /**
   * Indicates whether the specified value is a string.
   *
   * @param  {*}   value
   * @return {Boolean}
   */
  function isString(value) {
    return typeof value === 'string';
  }

  /**
   * Indicates whether the specified value is an object.
   *
   * @param  {*} value
   * @return {Boolean}
   *
   * @see https://github.com/jashkenas/underscore
   */
  function isObject(value) {
    var type = typeof value === 'undefined' ? 'undefined' : _typeof(value);

    return type === 'function' || type === 'object' && !!value; // eslint-disable-line no-mixed-operators
  }

  /**
   * Indicates whether the specified value is a number.
   *
   * @param  {*} value
   * @return {Boolean}
   */
  function isNumber(value) {
    return typeof value === 'number';
  }

  /**
   * Indicates whether the specified value is a function.
   *
   * @param  {*} value
   * @return {Boolean}
   */
  function isFunction(value) {
    return typeof value === 'function';
  }

  /**
   * Indicates whether the specified value is undefined.
   *
   * @param  {*} value
   * @return {Boolean}
   */
  function isUndefined(value) {
    return typeof value === 'undefined';
  }

  /**
   * Indicates whether the specified value is an array.
   *
   * @param  {*} value
   * @return {Boolean}
   */
  function isArray(value) {
    return value.constructor === Array;
  }

  /**
   * Creates and initializes specified collection of extensions.
   * Each extension receives access to instance of glide and rest of components.
   *
   * @param {Object} glide
   * @param {Object} extensions
   *
   * @returns {Object}
   */
  function mount(glide, extensions, events) {
    var components = {};

    for (var name in extensions) {
      if (isFunction(extensions[name])) {
        components[name] = extensions[name](glide, components, events);
      } else {
        warn('Extension must be a function');
      }
    }

    for (var _name in components) {
      if (isFunction(components[_name].mount)) {
        components[_name].mount();
      }
    }

    return components;
  }

  /**
   * Defines getter and setter property on the specified object.
   *
   * @param  {Object} obj         Object where property has to be defined.
   * @param  {String} prop        Name of the defined property.
   * @param  {Object} definition  Get and set definitions for the property.
   * @return {Void}
   */
  function define(obj, prop, definition) {
    Object.defineProperty(obj, prop, definition);
  }

  /**
   * Sorts aphabetically object keys.
   *
   * @param  {Object} obj
   * @return {Object}
   */
  function sortKeys(obj) {
    return Object.keys(obj).sort().reduce(function (r, k) {
      r[k] = obj[k];

      return r[k], r;
    }, {});
  }

  /**
   * Merges passed settings object with default options.
   *
   * @param  {Object} defaults
   * @param  {Object} settings
   * @return {Object}
   */
  function mergeOptions(defaults, settings) {
    var options = _extends({}, defaults, settings);

    // `Object.assign` do not deeply merge objects, so we
    // have to do it manually for every nested object
    // in options. Although it does not look smart,
    // it's smaller and faster than some fancy
    // merging deep-merge algorithm script.
    if (settings.hasOwnProperty('classes')) {
      options.classes = _extends({}, defaults.classes, settings.classes);

      if (settings.classes.hasOwnProperty('direction')) {
        options.classes.direction = _extends({}, defaults.classes.direction, settings.classes.direction);
      }
    }

    if (settings.hasOwnProperty('breakpoints')) {
      options.breakpoints = _extends({}, defaults.breakpoints, settings.breakpoints);
    }

    return options;
  }

  var EventsBus = function () {
    /**
     * Construct a EventBus instance.
     *
     * @param {Object} events
     */
    function EventsBus() {
      var events = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : {};
      classCallCheck(this, EventsBus);

      this.events = events;
      this.hop = events.hasOwnProperty;
    }

    /**
     * Adds listener to the specifed event.
     *
     * @param {String|Array} event
     * @param {Function} handler
     */


    createClass(EventsBus, [{
      key: 'on',
      value: function on(event, handler) {
        if (isArray(event)) {
          for (var i = 0; i < event.length; i++) {
            this.on(event[i], handler);
          }
        }

        // Create the event's object if not yet created
        if (!this.hop.call(this.events, event)) {
          this.events[event] = [];
        }

        // Add the handler to queue
        var index = this.events[event].push(handler) - 1;

        // Provide handle back for removal of event
        return {
          remove: function remove() {
            delete this.events[event][index];
          }
        };
      }

      /**
       * Runs registered handlers for specified event.
       *
       * @param {String|Array} event
       * @param {Object=} context
       */

    }, {
      key: 'emit',
      value: function emit(event, context) {
        if (isArray(event)) {
          for (var i = 0; i < event.length; i++) {
            this.emit(event[i], context);
          }
        }

        // If the event doesn't exist, or there's no handlers in queue, just leave
        if (!this.hop.call(this.events, event)) {
          return;
        }

        // Cycle through events queue, fire!
        this.events[event].forEach(function (item) {
          item(context || {});
        });
      }
    }]);
    return EventsBus;
  }();

  var Glide = function () {
    /**
     * Construct glide.
     *
     * @param  {String} selector
     * @param  {Object} options
     */
    function Glide(selector) {
      var options = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : {};
      classCallCheck(this, Glide);

      this._c = {};
      this._t = [];
      this._e = new EventsBus();

      this.disabled = false;
      this.selector = selector;
      this.settings = mergeOptions(defaults, options);
      this.index = this.settings.startAt;
    }

    /**
     * Initializes glide.
     *
     * @param {Object} extensions Collection of extensions to initialize.
     * @return {Glide}
     */


    createClass(Glide, [{
      key: 'mount',
      value: function mount$$1() {
        var extensions = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : {};

        this._e.emit('mount.before');

        if (isObject(extensions)) {
          this._c = mount(this, extensions, this._e);
        } else {
          warn('You need to provide a object on `mount()`');
        }

        this._e.emit('mount.after');

        return this;
      }

      /**
       * Collects an instance `translate` transformers.
       *
       * @param  {Array} transformers Collection of transformers.
       * @return {Void}
       */

    }, {
      key: 'mutate',
      value: function mutate() {
        var transformers = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : [];

        if (isArray(transformers)) {
          this._t = transformers;
        } else {
          warn('You need to provide a array on `mutate()`');
        }

        return this;
      }

      /**
       * Updates glide with specified settings.
       *
       * @param {Object} settings
       * @return {Glide}
       */

    }, {
      key: 'update',
      value: function update() {
        var settings = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : {};

        this.settings = mergeOptions(this.settings, settings);

        if (settings.hasOwnProperty('startAt')) {
          this.index = settings.startAt;
        }

        this._e.emit('update');

        return this;
      }

      /**
       * Change slide with specified pattern. A pattern must be in the special format:
       * `>` - Move one forward
       * `<` - Move one backward
       * `={i}` - Go to {i} zero-based slide (eq. '=1', will go to second slide)
       * `>>` - Rewinds to end (last slide)
       * `<<` - Rewinds to start (first slide)
       *
       * @param {String} pattern
       * @return {Glide}
       */

    }, {
      key: 'go',
      value: function go(pattern) {
        this._c.Run.make(pattern);

        return this;
      }

      /**
       * Move track by specified distance.
       *
       * @param {String} distance
       * @return {Glide}
       */

    }, {
      key: 'move',
      value: function move(distance) {
        this._c.Transition.disable();
        this._c.Move.make(distance);

        return this;
      }

      /**
       * Destroy instance and revert all changes done by this._c.
       *
       * @return {Glide}
       */

    }, {
      key: 'destroy',
      value: function destroy() {
        this._e.emit('destroy');

        return this;
      }

      /**
       * Start instance autoplaying.
       *
       * @param {Boolean|Number} interval Run autoplaying with passed interval regardless of `autoplay` settings
       * @return {Glide}
       */

    }, {
      key: 'play',
      value: function play() {
        var interval = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : false;

        if (interval) {
          this.settings.autoplay = interval;
        }

        this._e.emit('play');

        return this;
      }

      /**
       * Stop instance autoplaying.
       *
       * @return {Glide}
       */

    }, {
      key: 'pause',
      value: function pause() {
        this._e.emit('pause');

        return this;
      }

      /**
       * Sets glide into a idle status.
       *
       * @return {Glide}
       */

    }, {
      key: 'disable',
      value: function disable() {
        this.disabled = true;

        return this;
      }

      /**
       * Sets glide into a active status.
       *
       * @return {Glide}
       */

    }, {
      key: 'enable',
      value: function enable() {
        this.disabled = false;

        return this;
      }

      /**
       * Adds cuutom event listener with handler.
       *
       * @param  {String|Array} event
       * @param  {Function} handler
       * @return {Glide}
       */

    }, {
      key: 'on',
      value: function on(event, handler) {
        this._e.on(event, handler);

        return this;
      }

      /**
       * Checks if glide is a precised type.
       *
       * @param  {String} name
       * @return {Boolean}
       */

    }, {
      key: 'isType',
      value: function isType(name) {
        return this.settings.type === name;
      }

      /**
       * Gets value of the core options.
       *
       * @return {Object}
       */

    }, {
      key: 'settings',
      get: function get$$1() {
        return this._o;
      }

      /**
       * Sets value of the core options.
       *
       * @param  {Object} o
       * @return {Void}
       */
      ,
      set: function set$$1(o) {
        if (isObject(o)) {
          this._o = o;
        } else {
          warn('Options must be an `object` instance.');
        }
      }

      /**
       * Gets current index of the slider.
       *
       * @return {Object}
       */

    }, {
      key: 'index',
      get: function get$$1() {
        return this._i;
      }

      /**
       * Sets current index a slider.
       *
       * @return {Object}
       */
      ,
      set: function set$$1(i) {
        this._i = toInt(i);
      }

      /**
       * Gets type name of the slider.
       *
       * @return {String}
       */

    }, {
      key: 'type',
      get: function get$$1() {
        return this.settings.type;
      }

      /**
       * Gets value of the idle status.
       *
       * @return {Boolean}
       */

    }, {
      key: 'disabled',
      get: function get$$1() {
        return this._d;
      }

      /**
       * Sets value of the idle status.
       *
       * @return {Boolean}
       */
      ,
      set: function set$$1(status) {
        this._d = !!status;
      }
    }]);
    return Glide;
  }();

  function Run (Glide, Components, Events) {
    var Run = {
      /**
       * Initializes autorunning of the glide.
       *
       * @return {Void}
       */
      mount: function mount() {
        this._o = false;
      },


      /**
       * Makes glides running based on the passed moving schema.
       *
       * @param {String} move
       */
      make: function make(move) {
        var _this = this;

        if (!Glide.disabled) {
          Glide.disable();

          this.move = move;

          Events.emit('run.before', this.move);

          this.calculate();

          Events.emit('run', this.move);

          Components.Transition.after(function () {
            if (_this.isStart()) {
              Events.emit('run.start', _this.move);
            }

            if (_this.isEnd()) {
              Events.emit('run.end', _this.move);
            }

            if (_this.isOffset('<') || _this.isOffset('>')) {
              _this._o = false;

              Events.emit('run.offset', _this.move);
            }

            Events.emit('run.after', _this.move);

            Glide.enable();
          });
        }
      },


      /**
       * Calculates current index based on defined move.
       *
       * @return {Void}
       */
      calculate: function calculate() {
        var move = this.move,
            length = this.length;
        var steps = move.steps,
            direction = move.direction;


        var countableSteps = isNumber(toInt(steps)) && toInt(steps) !== 0;

        switch (direction) {
          case '>':
            if (steps === '>') {
              Glide.index = length;
            } else if (this.isEnd()) {
              if (!(Glide.isType('slider') && !Glide.settings.rewind)) {
                this._o = true;

                Glide.index = 0;
              }
            } else if (countableSteps) {
              Glide.index += Math.min(length - Glide.index, -toInt(steps));
            } else {
              Glide.index++;
            }
            break;

          case '<':
            if (steps === '<') {
              Glide.index = 0;
            } else if (this.isStart()) {
              if (!(Glide.isType('slider') && !Glide.settings.rewind)) {
                this._o = true;

                Glide.index = length;
              }
            } else if (countableSteps) {
              Glide.index -= Math.min(Glide.index, toInt(steps));
            } else {
              Glide.index--;
            }
            break;

          case '=':
            Glide.index = steps;
            break;

          default:
            warn('Invalid direction pattern [' + direction + steps + '] has been used');
            break;
        }
      },


      /**
       * Checks if we are on the first slide.
       *
       * @return {Boolean}
       */
      isStart: function isStart() {
        return Glide.index === 0;
      },


      /**
       * Checks if we are on the last slide.
       *
       * @return {Boolean}
       */
      isEnd: function isEnd() {
        return Glide.index === this.length;
      },


      /**
       * Checks if we are making a offset run.
       *
       * @param {String} direction
       * @return {Boolean}
       */
      isOffset: function isOffset(direction) {
        return this._o && this.move.direction === direction;
      }
    };

    define(Run, 'move', {
      /**
       * Gets value of the move schema.
       *
       * @returns {Object}
       */
      get: function get() {
        return this._m;
      },


      /**
       * Sets value of the move schema.
       *
       * @returns {Object}
       */
      set: function set(value) {
        var step = value.substr(1);

        this._m = {
          direction: value.substr(0, 1),
          steps: step ? toInt(step) ? toInt(step) : step : 0
        };
      }
    });

    define(Run, 'length', {
      /**
       * Gets value of the running distance based
       * on zero-indexing number of slides.
       *
       * @return {Number}
       */
      get: function get() {
        var settings = Glide.settings;
        var length = Components.Html.slides.length;

        // If the `bound` option is acitve, a maximum running distance should be
        // reduced by `perView` and `focusAt` settings. Running distance
        // should end before creating an empty space after instance.

        if (Glide.isType('slider') && settings.focusAt !== 'center' && settings.bound) {
          return length - 1 - (toInt(settings.perView) - 1) + toInt(settings.focusAt);
        }

        return length - 1;
      }
    });

    define(Run, 'offset', {
      /**
       * Gets status of the offsetting flag.
       *
       * @return {Boolean}
       */
      get: function get() {
        return this._o;
      }
    });

    return Run;
  }

  /**
   * Returns a current time.
   *
   * @return {Number}
   */
  function now() {
    return new Date().getTime();
  }

  /**
   * Returns a function, that, when invoked, will only be triggered
   * at most once during a given window of time.
   *
   * @param {Function} func
   * @param {Number} wait
   * @param {Object=} options
   * @return {Function}
   *
   * @see https://github.com/jashkenas/underscore
   */
  function throttle(func, wait, options) {
    var timeout = void 0,
        context = void 0,
        args = void 0,
        result = void 0;
    var previous = 0;
    if (!options) options = {};

    var later = function later() {
      previous = options.leading === false ? 0 : now();
      timeout = null;
      result = func.apply(context, args);
      if (!timeout) context = args = null;
    };

    var throttled = function throttled() {
      var at = now();
      if (!previous && options.leading === false) previous = at;
      var remaining = wait - (at - previous);
      context = this;
      args = arguments;
      if (remaining <= 0 || remaining > wait) {
        if (timeout) {
          clearTimeout(timeout);
          timeout = null;
        }
        previous = at;
        result = func.apply(context, args);
        if (!timeout) context = args = null;
      } else if (!timeout && options.trailing !== false) {
        timeout = setTimeout(later, remaining);
      }
      return result;
    };

    throttled.cancel = function () {
      clearTimeout(timeout);
      previous = 0;
      timeout = context = args = null;
    };

    return throttled;
  }

  var MARGIN_TYPE = {
    ltr: ['marginLeft', 'marginRight'],
    rtl: ['marginRight', 'marginLeft']
  };

  function Gaps (Glide, Components, Events) {
    var Gaps = {
      /**
       * Applies gaps between slides. First and last
       * slides do not receive it's edge margins.
       *
       * @param {HTMLCollection} slides
       * @return {Void}
       */
      apply: function apply(slides) {
        for (var i = 0, len = slides.length; i < len; i++) {
          var style = slides[i].style;
          var direction = Components.Direction.value;

          if (i !== 0) {
            style[MARGIN_TYPE[direction][0]] = this.value / 2 + 'px';
          } else {
            style[MARGIN_TYPE[direction][0]] = '';
          }

          if (i !== slides.length - 1) {
            style[MARGIN_TYPE[direction][1]] = this.value / 2 + 'px';
          } else {
            style[MARGIN_TYPE[direction][1]] = '';
          }
        }
      },


      /**
       * Removes gaps from the slides.
       *
       * @param {HTMLCollection} slides
       * @returns {Void}
      */
      remove: function remove(slides) {
        for (var i = 0, len = slides.length; i < len; i++) {
          var style = slides[i].style;

          style.marginLeft = '';
          style.marginRight = '';
        }
      }
    };

    define(Gaps, 'value', {
      /**
       * Gets value of the gap.
       *
       * @returns {Number}
       */
      get: function get() {
        return toInt(Glide.settings.gap);
      }
    });

    define(Gaps, 'grow', {
      /**
       * Gets additional dimentions value caused by gaps.
       * Used to increase width of the slides wrapper.
       *
       * @returns {Number}
       */
      get: function get() {
        return Gaps.value * (Components.Sizes.length - 1);
      }
    });

    define(Gaps, 'reductor', {
      /**
       * Gets reduction value caused by gaps.
       * Used to subtract width of the slides.
       *
       * @returns {Number}
       */
      get: function get() {
        var perView = Glide.settings.perView;

        return Gaps.value * (perView - 1) / perView;
      }
    });

    /**
     * Apply calculated gaps:
     * - after building, so slides (including clones) will receive proper margins
     * - on updating via API, to recalculate gaps with new options
     */
    Events.on(['build.after', 'update'], throttle(function () {
      Gaps.apply(Components.Html.wrapper.children);
    }, 30));

    /**
     * Remove gaps:
     * - on destroying to bring markup to its inital state
     */
    Events.on('destroy', function () {
      Gaps.remove(Components.Html.wrapper.children);
    });

    return Gaps;
  }

  /**
   * Finds siblings nodes of the passed node.
   *
   * @param  {Element} node
   * @return {Array}
   */
  function siblings(node) {
    if (node && node.parentNode) {
      var n = node.parentNode.firstChild;
      var matched = [];

      for (; n; n = n.nextSibling) {
        if (n.nodeType === 1 && n !== node) {
          matched.push(n);
        }
      }

      return matched;
    }

    return [];
  }

  /**
   * Checks if passed node exist and is a valid element.
   *
   * @param  {Element} node
   * @return {Boolean}
   */
  function exist(node) {
    if (node && node instanceof window.HTMLElement) {
      return true;
    }

    return false;
  }

  var TRACK_SELECTOR = '[data-glide-el="track"]';

  function Html (Glide, Components) {
    var Html = {
      /**
       * Setup slider HTML nodes.
       *
       * @param {Glide} glide
       */
      mount: function mount() {
        this.root = Glide.selector;
        this.track = this.root.querySelector(TRACK_SELECTOR);
        this.slides = Array.prototype.slice.call(this.wrapper.children).filter(function (slide) {
          return !slide.classList.contains(Glide.settings.classes.cloneSlide);
        });
      }
    };

    define(Html, 'root', {
      /**
       * Gets node of the glide main element.
       *
       * @return {Object}
       */
      get: function get() {
        return Html._r;
      },


      /**
       * Sets node of the glide main element.
       *
       * @return {Object}
       */
      set: function set(r) {
        if (isString(r)) {
          r = document.querySelector(r);
        }

        if (exist(r)) {
          Html._r = r;
        } else {
          warn('Root element must be a existing Html node');
        }
      }
    });

    define(Html, 'track', {
      /**
       * Gets node of the glide track with slides.
       *
       * @return {Object}
       */
      get: function get() {
        return Html._t;
      },


      /**
       * Sets node of the glide track with slides.
       *
       * @return {Object}
       */
      set: function set(t) {
        if (exist(t)) {
          Html._t = t;
        } else {
          warn('Could not find track element. Please use ' + TRACK_SELECTOR + ' attribute.');
        }
      }
    });

    define(Html, 'wrapper', {
      /**
       * Gets node of the slides wrapper.
       *
       * @return {Object}
       */
      get: function get() {
        return Html.track.children[0];
      }
    });

    return Html;
  }

  function Peek (Glide, Components, Events) {
    var Peek = {
      /**
       * Setups how much to peek based on settings.
       *
       * @return {Void}
       */
      mount: function mount() {
        this.value = Glide.settings.peek;
      }
    };

    define(Peek, 'value', {
      /**
       * Gets value of the peek.
       *
       * @returns {Number|Object}
       */
      get: function get() {
        return Peek._v;
      },


      /**
       * Sets value of the peek.
       *
       * @param {Number|Object} value
       * @return {Void}
       */
      set: function set(value) {
        if (isObject(value)) {
          value.before = toInt(value.before);
          value.after = toInt(value.after);
        } else {
          value = toInt(value);
        }

        Peek._v = value;
      }
    });

    define(Peek, 'reductor', {
      /**
       * Gets reduction value caused by peek.
       *
       * @returns {Number}
       */
      get: function get() {
        var value = Peek.value;
        var perView = Glide.settings.perView;

        if (isObject(value)) {
          return value.before / perView + value.after / perView;
        }

        return value * 2 / perView;
      }
    });

    /**
     * Recalculate peeking sizes on:
     * - when resizing window to update to proper percents
     */
    Events.on(['resize', 'update'], function () {
      Peek.mount();
    });

    return Peek;
  }

  function Move (Glide, Components, Events) {
    var Move = {
      /**
       * Constructs move component.
       *
       * @returns {Void}
       */
      mount: function mount() {
        this._o = 0;
      },


      /**
       * Calculates a movement value based on passed offset and currently active index.
       *
       * @param  {Number} offset
       * @return {Void}
       */
      make: function make() {
        var _this = this;

        var offset = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : 0;

        this.offset = offset;

        Events.emit('move', {
          movement: this.value
        });

        Components.Transition.after(function () {
          Events.emit('move.after', {
            movement: _this.value
          });
        });
      }
    };

    define(Move, 'offset', {
      /**
       * Gets an offset value used to modify current translate.
       *
       * @return {Object}
       */
      get: function get() {
        return Move._o;
      },


      /**
       * Sets an offset value used to modify current translate.
       *
       * @return {Object}
       */
      set: function set(value) {
        Move._o = !isUndefined(value) ? toInt(value) : 0;
      }
    });

    define(Move, 'translate', {
      /**
       * Gets a raw movement value.
       *
       * @return {Number}
       */
      get: function get() {
        return Components.Sizes.slideWidth * Glide.index;
      }
    });

    define(Move, 'value', {
      /**
       * Gets an actual movement value corrected by offset.
       *
       * @return {Number}
       */
      get: function get() {
        var offset = this.offset;
        var translate = this.translate;

        if (Components.Direction.is('rtl')) {
          return translate + offset;
        }

        return translate - offset;
      }
    });

    /**
     * Make movement to proper slide on:
     * - before build, so glide will start at `startAt` index
     * - on each standard run to move to newly calculated index
     */
    Events.on(['build.before', 'run'], function () {
      Move.make();
    });

    return Move;
  }

  function Sizes (Glide, Components, Events) {
    var Sizes = {
      /**
       * Setups dimentions of slides.
       *
       * @return {Void}
       */
      setupSlides: function setupSlides() {
        var width = this.slideWidth + 'px';
        var slides = Components.Html.slides;

        for (var i = 0; i < slides.length; i++) {
          slides[i].style.width = width;
        }
      },


      /**
       * Setups dimentions of slides wrapper.
       *
       * @return {Void}
       */
      setupWrapper: function setupWrapper(dimention) {
        Components.Html.wrapper.style.width = this.wrapperSize + 'px';
      },


      /**
       * Removes applied styles from HTML elements.
       *
       * @returns {Void}
       */
      remove: function remove() {
        var slides = Components.Html.slides;

        for (var i = 0; i < slides.length; i++) {
          slides[i].style.width = '';
        }

        Components.Html.wrapper.style.width = '';
      }
    };

    define(Sizes, 'length', {
      /**
       * Gets count number of the slides.
       *
       * @return {Number}
       */
      get: function get() {
        return Components.Html.slides.length;
      }
    });

    define(Sizes, 'width', {
      /**
       * Gets width value of the glide.
       *
       * @return {Number}
       */
      get: function get() {
        return Components.Html.root.offsetWidth;
      }
    });

    define(Sizes, 'wrapperSize', {
      /**
       * Gets size of the slides wrapper.
       *
       * @return {Number}
       */
      get: function get() {
        return Sizes.slideWidth * Sizes.length + Components.Gaps.grow + Components.Clones.grow;
      }
    });

    define(Sizes, 'slideWidth', {
      /**
       * Gets width value of the single slide.
       *
       * @return {Number}
       */
      get: function get() {
        return Sizes.width / Glide.settings.perView - Components.Peek.reductor - Components.Gaps.reductor;
      }
    });

    /**
     * Apply calculated glide's dimensions:
     * - before building, so other dimentions (e.g. translate) will be calculated propertly
     * - when resizing window to recalculate sildes dimensions
     * - on updating via API, to calculate dimensions based on new options
     */
    Events.on(['build.before', 'resize', 'update'], function () {
      Sizes.setupSlides();
      Sizes.setupWrapper();
    });

    /**
     * Remove calculated glide's dimensions:
     * - on destoting to bring markup to its inital state
     */
    Events.on('destroy', function () {
      Sizes.remove();
    });

    return Sizes;
  }

  function Build (Glide, Components, Events) {
    var Build = {
      /**
       * Init glide building. Adds classes, sets
       * dimensions and setups initial state.
       *
       * @return {Void}
       */
      mount: function mount() {
        Events.emit('build.before');

        this.typeClass();
        this.activeClass();

        Events.emit('build.after');
      },


      /**
       * Adds `type` class to the glide element.
       *
       * @return {Void}
       */
      typeClass: function typeClass() {
        Components.Html.root.classList.add(Glide.settings.classes[Glide.settings.type]);
      },


      /**
       * Sets active class to current slide.
       *
       * @return {Void}
       */
      activeClass: function activeClass() {
        var classes = Glide.settings.classes;
        var slide = Components.Html.slides[Glide.index];

        if (slide) {
          slide.classList.add(classes.activeSlide);

          siblings(slide).forEach(function (sibling) {
            sibling.classList.remove(classes.activeSlide);
          });
        }
      },


      /**
       * Removes HTML classes applied at building.
       *
       * @return {Void}
       */
      removeClasses: function removeClasses() {
        var classes = Glide.settings.classes;

        Components.Html.root.classList.remove(classes[Glide.settings.type]);

        Components.Html.slides.forEach(function (sibling) {
          sibling.classList.remove(classes.activeSlide);
        });
      }
    };

    /**
     * Clear building classes:
     * - on destroying to bring HTML to its initial state
     * - on updating to remove classes before remounting component
     */
    Events.on(['destroy', 'update'], function () {
      Build.removeClasses();
    });

    /**
     * Remount component:
     * - on resizing of the window to calculate new dimentions
     * - on updating settings via API
     */
    Events.on(['resize', 'update'], function () {
      Build.mount();
    });

    /**
     * Swap active class of current slide:
     * - after each move to the new index
     */
    Events.on('move.after', function () {
      Build.activeClass();
    });

    return Build;
  }

  function Clones (Glide, Components, Events) {
    var Clones = {
      /**
       * Create pattern map and collect slides to be cloned.
       */
      mount: function mount() {
        this.items = [];

        if (Glide.isType('carousel')) {
          this.items = this.collect();
        }
      },


      /**
       * Collect clones with pattern.
       *
       * @return {Void}
       */
      collect: function collect() {
        var items = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : [];
        var slides = Components.Html.slides;
        var _Glide$settings = Glide.settings,
            perView = _Glide$settings.perView,
            classes = _Glide$settings.classes;


        var peekIncrementer = +!!Glide.settings.peek;
        var part = perView + peekIncrementer;
        var start = slides.slice(0, part);
        var end = slides.slice(-part);

        for (var r = 0; r < Math.max(1, Math.floor(perView / slides.length)); r++) {
          for (var i = 0; i < start.length; i++) {
            var clone = start[i].cloneNode(true);

            clone.classList.add(classes.cloneSlide);

            items.push(clone);
          }

          for (var _i = 0; _i < end.length; _i++) {
            var _clone = end[_i].cloneNode(true);

            _clone.classList.add(classes.cloneSlide);

            items.unshift(_clone);
          }
        }

        return items;
      },


      /**
       * Append cloned slides with generated pattern.
       *
       * @return {Void}
       */
      append: function append() {
        var items = this.items;
        var _Components$Html = Components.Html,
            wrapper = _Components$Html.wrapper,
            slides = _Components$Html.slides;


        var half = Math.floor(items.length / 2);
        var prepend = items.slice(0, half).reverse();
        var append = items.slice(half, items.length);
        var width = Components.Sizes.slideWidth + 'px';

        for (var i = 0; i < append.length; i++) {
          wrapper.appendChild(append[i]);
        }

        for (var _i2 = 0; _i2 < prepend.length; _i2++) {
          wrapper.insertBefore(prepend[_i2], slides[0]);
        }

        for (var _i3 = 0; _i3 < items.length; _i3++) {
          items[_i3].style.width = width;
        }
      },


      /**
       * Remove all cloned slides.
       *
       * @return {Void}
       */
      remove: function remove() {
        var items = this.items;


        for (var i = 0; i < items.length; i++) {
          Components.Html.wrapper.removeChild(items[i]);
        }
      }
    };

    define(Clones, 'grow', {
      /**
       * Gets additional dimentions value caused by clones.
       *
       * @return {Number}
       */
      get: function get() {
        return (Components.Sizes.slideWidth + Components.Gaps.value) * Clones.items.length;
      }
    });

    /**
     * Append additional slide's clones:
     * - while glide's type is `carousel`
     */
    Events.on('update', function () {
      Clones.remove();
      Clones.mount();
      Clones.append();
    });

    /**
     * Append additional slide's clones:
     * - while glide's type is `carousel`
     */
    Events.on('build.before', function () {
      if (Glide.isType('carousel')) {
        Clones.append();
      }
    });

    /**
     * Remove clones HTMLElements:
     * - on destroying, to bring HTML to its initial state
     */
    Events.on('destroy', function () {
      Clones.remove();
    });

    return Clones;
  }

  var EventsBinder = function () {
    /**
     * Construct a EventsBinder instance.
     */
    function EventsBinder() {
      var listeners = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : {};
      classCallCheck(this, EventsBinder);

      this.listeners = listeners;
    }

    /**
     * Adds events listeners to arrows HTML elements.
     *
     * @param  {String|Array} events
     * @param  {Element|Window|Document} el
     * @param  {Function} closure
     * @param  {Boolean|Object} capture
     * @return {Void}
     */


    createClass(EventsBinder, [{
      key: 'on',
      value: function on(events, el, closure) {
        var capture = arguments.length > 3 && arguments[3] !== undefined ? arguments[3] : false;

        if (isString(events)) {
          events = [events];
        }

        for (var i = 0; i < events.length; i++) {
          this.listeners[events[i]] = closure;

          el.addEventListener(events[i], this.listeners[events[i]], capture);
        }
      }

      /**
       * Removes event listeners from arrows HTML elements.
       *
       * @param  {String|Array} events
       * @param  {Element|Window|Document} el
       * @param  {Boolean|Object} capture
       * @return {Void}
       */

    }, {
      key: 'off',
      value: function off(events, el) {
        var capture = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : false;

        if (isString(events)) {
          events = [events];
        }

        for (var i = 0; i < events.length; i++) {
          el.removeEventListener(events[i], this.listeners[events[i]], capture);
        }
      }

      /**
       * Destroy collected listeners.
       *
       * @returns {Void}
       */

    }, {
      key: 'destroy',
      value: function destroy() {
        delete this.listeners;
      }
    }]);
    return EventsBinder;
  }();

  function Resize (Glide, Components, Events) {
    /**
     * Instance of the binder for DOM Events.
     *
     * @type {EventsBinder}
     */
    var Binder = new EventsBinder();

    var Resize = {
      /**
       * Initializes window bindings.
       */
      mount: function mount() {
        this.bind();
      },


      /**
       * Binds `rezsize` listener to the window.
       * It's a costly event, so we are debouncing it.
       *
       * @return {Void}
       */
      bind: function bind() {
        Binder.on('resize', window, throttle(function () {
          Events.emit('resize');
        }, Glide.settings.throttle));
      },


      /**
       * Unbinds listeners from the window.
       *
       * @return {Void}
       */
      unbind: function unbind() {
        Binder.off('resize', window);
      }
    };

    /**
     * Remove bindings from window:
     * - on destroying, to remove added EventListener
     */
    Events.on('destroy', function () {
      Resize.unbind();
      Binder.destroy();
    });

    return Resize;
  }

  var VALID_DIRECTIONS = ['ltr', 'rtl'];
  var FLIPED_MOVEMENTS = {
    '>': '<',
    '<': '>',
    '=': '='
  };

  function Direction (Glide, Components, Events) {
    var Direction = {
      /**
       * Setups gap value based on settings.
       *
       * @return {Void}
       */
      mount: function mount() {
        this.value = Glide.settings.direction;
      },


      /**
       * Resolves pattern based on direction value
       *
       * @param {String} pattern
       * @returns {String}
       */
      resolve: function resolve(pattern) {
        var token = pattern.slice(0, 1);

        if (this.is('rtl')) {
          return pattern.split(token).join(FLIPED_MOVEMENTS[token]);
        }

        return pattern;
      },


      /**
       * Checks value of direction mode.
       *
       * @param {String} direction
       * @returns {Boolean}
       */
      is: function is(direction) {
        return this.value === direction;
      },


      /**
       * Applies direction class to the root HTML element.
       *
       * @return {Void}
       */
      addClass: function addClass() {
        Components.Html.root.classList.add(Glide.settings.classes.direction[this.value]);
      },


      /**
       * Removes direction class from the root HTML element.
       *
       * @return {Void}
       */
      removeClass: function removeClass() {
        Components.Html.root.classList.remove(Glide.settings.classes.direction[this.value]);
      }
    };

    define(Direction, 'value', {
      /**
       * Gets value of the direction.
       *
       * @returns {Number}
       */
      get: function get() {
        return Direction._v;
      },


      /**
       * Sets value of the direction.
       *
       * @param {String} value
       * @return {Void}
       */
      set: function set(value) {
        if (VALID_DIRECTIONS.indexOf(value) > -1) {
          Direction._v = value;
        } else {
          warn('Direction value must be `ltr` or `rtl`');
        }
      }
    });

    /**
     * Clear direction class:
     * - on destroy to bring HTML to its initial state
     * - on update to remove class before reappling bellow
     */
    Events.on(['destroy', 'update'], function () {
      Direction.removeClass();
    });

    /**
     * Remount component:
     * - on update to reflect changes in direction value
     */
    Events.on('update', function () {
      Direction.mount();
    });

    /**
     * Apply direction class:
     * - before building to apply class for the first time
     * - on updating to reapply direction class that may changed
     */
    Events.on(['build.before', 'update'], function () {
      Direction.addClass();
    });

    return Direction;
  }

  /**
   * Reflects value of glide movement.
   *
   * @param  {Object} Glide
   * @param  {Object} Components
   * @return {Object}
   */
  function Rtl (Glide, Components) {
    return {
      /**
       * Negates the passed translate if glide is in RTL option.
       *
       * @param  {Number} translate
       * @return {Number}
       */
      modify: function modify(translate) {
        if (Components.Direction.is('rtl')) {
          return -translate;
        }

        return translate;
      }
    };
  }

  /**
   * Updates glide movement with a `gap` settings.
   *
   * @param  {Object} Glide
   * @param  {Object} Components
   * @return {Object}
   */
  function Gap (Glide, Components) {
    return {
      /**
       * Modifies passed translate value with number in the `gap` settings.
       *
       * @param  {Number} translate
       * @return {Number}
       */
      modify: function modify(translate) {
        return translate + Components.Gaps.value * Glide.index;
      }
    };
  }

  /**
   * Updates glide movement with width of additional clones width.
   *
   * @param  {Object} Glide
   * @param  {Object} Components
   * @return {Object}
   */
  function Grow (Glide, Components) {
    return {
      /**
       * Adds to the passed translate width of the half of clones.
       *
       * @param  {Number} translate
       * @return {Number}
       */
      modify: function modify(translate) {
        return translate + Components.Clones.grow / 2;
      }
    };
  }

  /**
   * Updates glide movement with a `peek` settings.
   *
   * @param  {Object} Glide
   * @param  {Object} Components
   * @return {Object}
   */
  function Peeking (Glide, Components) {
    return {
      /**
       * Modifies passed translate value with a `peek` setting.
       *
       * @param  {Number} translate
       * @return {Number}
       */
      modify: function modify(translate) {
        if (Glide.settings.focusAt >= 0) {
          var peek = Components.Peek.value;

          if (isObject(peek)) {
            return translate - peek.before;
          }

          return translate - peek;
        }

        return translate;
      }
    };
  }

  /**
   * Updates glide movement with a `focusAt` settings.
   *
   * @param  {Object} Glide
   * @param  {Object} Components
   * @return {Object}
   */
  function Focusing (Glide, Components) {
    return {
      /**
       * Modifies passed translate value with index in the `focusAt` setting.
       *
       * @param  {Number} translate
       * @return {Number}
       */
      modify: function modify(translate) {
        var gap = Components.Gaps.value;
        var width = Components.Sizes.width;
        var focusAt = Glide.settings.focusAt;
        var slideWidth = Components.Sizes.slideWidth;

        if (focusAt === 'center') {
          return translate - (width / 2 - slideWidth / 2);
        }

        return translate - slideWidth * focusAt - gap * focusAt;
      }
    };
  }

  /**
   * Applies diffrent transformers on translate value.
   *
   * @param  {Object} Glide
   * @param  {Object} Components
   * @return {Object}
   */
  function mutator (Glide, Components, Events) {
    /**
     * Merge instance transformers with collection of default transformers.
     * It's important that the Rtl component be last on the list,
     * so it reflects all previous transformations.
     *
     * @type {Array}
     */
    var TRANSFORMERS = [Gap, Grow, Peeking, Focusing].concat(Glide._t, [Rtl]);

    return {
      /**
       * Piplines translate value with registered transformers.
       *
       * @param  {Number} translate
       * @return {Number}
       */
      mutate: function mutate(translate) {
        for (var i = 0; i < TRANSFORMERS.length; i++) {
          var transformer = TRANSFORMERS[i];

          if (isFunction(transformer) && isFunction(transformer().modify)) {
            translate = transformer(Glide, Components, Events).modify(translate);
          } else {
            warn('Transformer should be a function that returns an object with `modify()` method');
          }
        }

        return translate;
      }
    };
  }

  function Translate (Glide, Components, Events) {
    var Translate = {
      /**
       * Sets value of translate on HTML element.
       *
       * @param {Number} value
       * @return {Void}
       */
      set: function set(value) {
        var transform = mutator(Glide, Components).mutate(value);

        Components.Html.wrapper.style.transform = 'translate3d(' + -1 * transform + 'px, 0px, 0px)';
      },


      /**
       * Removes value of translate from HTML element.
       *
       * @return {Void}
       */
      remove: function remove() {
        Components.Html.wrapper.style.transform = '';
      }
    };

    /**
     * Set new translate value:
     * - on move to reflect index change
     * - on updating via API to reflect possible changes in options
     */
    Events.on('move', function (context) {
      var gap = Components.Gaps.value;
      var length = Components.Sizes.length;
      var width = Components.Sizes.slideWidth;

      if (Glide.isType('carousel') && Components.Run.isOffset('<')) {
        Components.Transition.after(function () {
          Events.emit('translate.jump');

          Translate.set(width * (length - 1));
        });

        return Translate.set(-width - gap * length);
      }

      if (Glide.isType('carousel') && Components.Run.isOffset('>')) {
        Components.Transition.after(function () {
          Events.emit('translate.jump');

          Translate.set(0);
        });

        return Translate.set(width * length + gap * length);
      }

      return Translate.set(context.movement);
    });

    /**
     * Remove translate:
     * - on destroying to bring markup to its inital state
     */
    Events.on('destroy', function () {
      Translate.remove();
    });

    return Translate;
  }

  function Transition (Glide, Components, Events) {
    /**
     * Holds inactivity status of transition.
     * When true transition is not applied.
     *
     * @type {Boolean}
     */
    var disabled = false;

    var Transition = {
      /**
       * Composes string of the CSS transition.
       *
       * @param {String} property
       * @return {String}
       */
      compose: function compose(property) {
        var settings = Glide.settings;

        if (!disabled) {
          return property + ' ' + this.duration + 'ms ' + settings.animationTimingFunc;
        }

        return property + ' 0ms ' + settings.animationTimingFunc;
      },


      /**
       * Sets value of transition on HTML element.
       *
       * @param {String=} property
       * @return {Void}
       */
      set: function set() {
        var property = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : 'transform';

        Components.Html.wrapper.style.transition = this.compose(property);
      },


      /**
       * Removes value of transition from HTML element.
       *
       * @return {Void}
       */
      remove: function remove() {
        Components.Html.wrapper.style.transition = '';
      },


      /**
       * Runs callback after animation.
       *
       * @param  {Function} callback
       * @return {Void}
       */
      after: function after(callback) {
        setTimeout(function () {
          callback();
        }, this.duration);
      },


      /**
       * Enable transition.
       *
       * @return {Void}
       */
      enable: function enable() {
        disabled = false;

        this.set();
      },


      /**
       * Disable transition.
       *
       * @return {Void}
       */
      disable: function disable() {
        disabled = true;

        this.set();
      }
    };

    define(Transition, 'duration', {
      /**
       * Gets duration of the transition based
       * on currently running animation type.
       *
       * @return {Number}
       */
      get: function get() {
        var settings = Glide.settings;

        if (Glide.isType('slider') && Components.Run.offset) {
          return settings.rewindDuration;
        }

        return settings.animationDuration;
      }
    });

    /**
     * Set transition `style` value:
     * - on each moving, because it may be cleared by offset move
     */
    Events.on('move', function () {
      Transition.set();
    });

    /**
     * Disable transition:
     * - before initial build to avoid transitioning from `0` to `startAt` index
     * - while resizing window and recalculating dimentions
     * - on jumping from offset transition at start and end edges in `carousel` type
     */
    Events.on(['build.before', 'resize', 'translate.jump'], function () {
      Transition.disable();
    });

    /**
     * Enable transition:
     * - on each running, because it may be disabled by offset move
     */
    Events.on('run', function () {
      Transition.enable();
    });

    /**
     * Remove transition:
     * - on destroying to bring markup to its inital state
     */
    Events.on('destroy', function () {
      Transition.remove();
    });

    return Transition;
  }

  /**
   * Test via a getter in the options object to see
   * if the passive property is accessed.
   *
   * @see https://github.com/WICG/EventListenerOptions/blob/gh-pages/explainer.md#feature-detection
   */

  var supportsPassive = false;

  try {
    var opts = Object.defineProperty({}, 'passive', {
      get: function get() {
        supportsPassive = true;
      }
    });

    window.addEventListener('testPassive', null, opts);
    window.removeEventListener('testPassive', null, opts);
  } catch (e) {}

  var supportsPassive$1 = supportsPassive;

  var START_EVENTS = ['touchstart', 'mousedown'];
  var MOVE_EVENTS = ['touchmove', 'mousemove'];
  var END_EVENTS = ['touchend', 'touchcancel', 'mouseup', 'mouseleave'];
  var MOUSE_EVENTS = ['mousedown', 'mousemove', 'mouseup', 'mouseleave'];

  function Swipe (Glide, Components, Events) {
    /**
     * Instance of the binder for DOM Events.
     *
     * @type {EventsBinder}
     */
    var Binder = new EventsBinder();

    var swipeSin = 0;
    var swipeStartX = 0;
    var swipeStartY = 0;
    var disabled = false;
    var capture = supportsPassive$1 ? { passive: true } : false;

    var Swipe = {
      /**
       * Initializes swipe bindings.
       *
       * @return {Void}
       */
      mount: function mount() {
        this.bindSwipeStart();
      },


      /**
       * Handler for `swipestart` event. Calculates entry points of the user's tap.
       *
       * @param {Object} event
       * @return {Void}
       */
      start: function start(event) {
        if (!disabled && !Glide.disabled) {
          this.disable();

          var swipe = this.touches(event);

          swipeSin = null;
          swipeStartX = toInt(swipe.pageX);
          swipeStartY = toInt(swipe.pageY);

          this.bindSwipeMove();
          this.bindSwipeEnd();

          Events.emit('swipe.start');
        }
      },


      /**
       * Handler for `swipemove` event. Calculates user's tap angle and distance.
       *
       * @param {Object} event
       */
      move: function move(event) {
        if (!Glide.disabled) {
          var _Glide$settings = Glide.settings,
              touchAngle = _Glide$settings.touchAngle,
              touchRatio = _Glide$settings.touchRatio,
              classes = _Glide$settings.classes;


          var swipe = this.touches(event);

          var subExSx = toInt(swipe.pageX) - swipeStartX;
          var subEySy = toInt(swipe.pageY) - swipeStartY;
          var powEX = Math.abs(subExSx << 2);
          var powEY = Math.abs(subEySy << 2);
          var swipeHypotenuse = Math.sqrt(powEX + powEY);
          var swipeCathetus = Math.sqrt(powEY);

          swipeSin = Math.asin(swipeCathetus / swipeHypotenuse);

          if (swipeSin * 180 / Math.PI < touchAngle) {
            event.stopPropagation();

            Components.Move.make(subExSx * toFloat(touchRatio));

            Components.Html.root.classList.add(classes.dragging);

            Events.emit('swipe.move');
          } else {
            return false;
          }
        }
      },


      /**
       * Handler for `swipeend` event. Finitializes user's tap and decides about glide move.
       *
       * @param {Object} event
       * @return {Void}
       */
      end: function end(event) {
        if (!Glide.disabled) {
          var settings = Glide.settings;

          var swipe = this.touches(event);
          var threshold = this.threshold(event);

          var swipeDistance = swipe.pageX - swipeStartX;
          var swipeDeg = swipeSin * 180 / Math.PI;
          var steps = Math.round(swipeDistance / Components.Sizes.slideWidth);

          this.enable();

          if (swipeDistance > threshold && swipeDeg < settings.touchAngle) {
            // While swipe is positive and greater than threshold move backward.
            if (settings.perTouch) {
              steps = Math.min(steps, toInt(settings.perTouch));
            }

            if (Components.Direction.is('rtl')) {
              steps = -steps;
            }

            Components.Run.make(Components.Direction.resolve('<' + steps));
          } else if (swipeDistance < -threshold && swipeDeg < settings.touchAngle) {
            // While swipe is negative and lower than negative threshold move forward.
            if (settings.perTouch) {
              steps = Math.max(steps, -toInt(settings.perTouch));
            }

            if (Components.Direction.is('rtl')) {
              steps = -steps;
            }

            Components.Run.make(Components.Direction.resolve('>' + steps));
          } else {
            // While swipe don't reach distance apply previous transform.
            Components.Move.make();
          }

          Components.Html.root.classList.remove(settings.classes.dragging);

          this.unbindSwipeMove();
          this.unbindSwipeEnd();

          Events.emit('swipe.end');
        }
      },


      /**
       * Binds swipe's starting event.
       *
       * @return {Void}
       */
      bindSwipeStart: function bindSwipeStart() {
        var _this = this;

        var settings = Glide.settings;

        if (settings.swipeThreshold) {
          Binder.on(START_EVENTS[0], Components.Html.wrapper, function (event) {
            _this.start(event);
          }, capture);
        }

        if (settings.dragThreshold) {
          Binder.on(START_EVENTS[1], Components.Html.wrapper, function (event) {
            _this.start(event);
          }, capture);
        }
      },


      /**
       * Unbinds swipe's starting event.
       *
       * @return {Void}
       */
      unbindSwipeStart: function unbindSwipeStart() {
        Binder.off(START_EVENTS[0], Components.Html.wrapper, capture);
        Binder.off(START_EVENTS[1], Components.Html.wrapper, capture);
      },


      /**
       * Binds swipe's moving event.
       *
       * @return {Void}
       */
      bindSwipeMove: function bindSwipeMove() {
        var _this2 = this;

        Binder.on(MOVE_EVENTS, Components.Html.wrapper, throttle(function (event) {
          _this2.move(event);
        }, Glide.settings.throttle), capture);
      },


      /**
       * Unbinds swipe's moving event.
       *
       * @return {Void}
       */
      unbindSwipeMove: function unbindSwipeMove() {
        Binder.off(MOVE_EVENTS, Components.Html.wrapper, capture);
      },


      /**
       * Binds swipe's ending event.
       *
       * @return {Void}
       */
      bindSwipeEnd: function bindSwipeEnd() {
        var _this3 = this;

        Binder.on(END_EVENTS, Components.Html.wrapper, function (event) {
          _this3.end(event);
        });
      },


      /**
       * Unbinds swipe's ending event.
       *
       * @return {Void}
       */
      unbindSwipeEnd: function unbindSwipeEnd() {
        Binder.off(END_EVENTS, Components.Html.wrapper);
      },


      /**
       * Normalizes event touches points accorting to different types.
       *
       * @param {Object} event
       */
      touches: function touches(event) {
        if (MOUSE_EVENTS.indexOf(event.type) > -1) {
          return event;
        }

        return event.touches[0] || event.changedTouches[0];
      },


      /**
       * Gets value of minimum swipe distance settings based on event type.
       *
       * @return {Number}
       */
      threshold: function threshold(event) {
        var settings = Glide.settings;

        if (MOUSE_EVENTS.indexOf(event.type) > -1) {
          return settings.dragThreshold;
        }

        return settings.swipeThreshold;
      },


      /**
       * Enables swipe event.
       *
       * @return {self}
       */
      enable: function enable() {
        disabled = false;

        Components.Transition.enable();

        return this;
      },


      /**
       * Disables swipe event.
       *
       * @return {self}
       */
      disable: function disable() {
        disabled = true;

        Components.Transition.disable();

        return this;
      }
    };

    /**
     * Add component class:
     * - after initial building
     */
    Events.on('build.after', function () {
      Components.Html.root.classList.add(Glide.settings.classes.swipeable);
    });

    /**
     * Remove swiping bindings:
     * - on destroying, to remove added EventListeners
     */
    Events.on('destroy', function () {
      Swipe.unbindSwipeStart();
      Swipe.unbindSwipeMove();
      Swipe.unbindSwipeEnd();
      Binder.destroy();
    });

    return Swipe;
  }

  function Images (Glide, Components, Events) {
    /**
     * Instance of the binder for DOM Events.
     *
     * @type {EventsBinder}
     */
    var Binder = new EventsBinder();

    var Images = {
      /**
       * Binds listener to glide wrapper.
       *
       * @return {Void}
       */
      mount: function mount() {
        this.bind();
      },


      /**
       * Binds `dragstart` event on wrapper to prevent dragging images.
       *
       * @return {Void}
       */
      bind: function bind() {
        Binder.on('dragstart', Components.Html.wrapper, this.dragstart);
      },


      /**
       * Unbinds `dragstart` event on wrapper.
       *
       * @return {Void}
       */
      unbind: function unbind() {
        Binder.off('dragstart', Components.Html.wrapper);
      },


      /**
       * Event handler. Prevents dragging.
       *
       * @return {Void}
       */
      dragstart: function dragstart(event) {
        event.preventDefault();
      }
    };

    /**
     * Remove bindings from images:
     * - on destroying, to remove added EventListeners
     */
    Events.on('destroy', function () {
      Images.unbind();
      Binder.destroy();
    });

    return Images;
  }

  function Anchors (Glide, Components, Events) {
    /**
     * Instance of the binder for DOM Events.
     *
     * @type {EventsBinder}
     */
    var Binder = new EventsBinder();

    /**
     * Holds detaching status of anchors.
     * Prevents detaching of already detached anchors.
     *
     * @private
     * @type {Boolean}
     */
    var detached = false;

    /**
     * Holds preventing status of anchors.
     * If `true` redirection after click will be disabled.
     *
     * @private
     * @type {Boolean}
     */
    var prevented = false;

    var Anchors = {
      /**
       * Setups a initial state of anchors component.
       *
       * @returns {Void}
       */
      mount: function mount() {
        /**
         * Holds collection of anchors elements.
         *
         * @private
         * @type {HTMLCollection}
         */
        this._a = Components.Html.wrapper.querySelectorAll('a');

        this.bind();
      },


      /**
       * Binds events to anchors inside a track.
       *
       * @return {Void}
       */
      bind: function bind() {
        Binder.on('click', Components.Html.wrapper, this.click);
      },


      /**
       * Unbinds events attached to anchors inside a track.
       *
       * @return {Void}
       */
      unbind: function unbind() {
        Binder.off('click', Components.Html.wrapper);
      },


      /**
       * Handler for click event. Prevents clicks when glide is in `prevent` status.
       *
       * @param  {Object} event
       * @return {Void}
       */
      click: function click(event) {
        if (prevented) {
          event.stopPropagation();
          event.preventDefault();
        }
      },


      /**
       * Detaches anchors click event inside glide.
       *
       * @return {self}
       */
      detach: function detach() {
        prevented = true;

        if (!detached) {
          for (var i = 0; i < this.items.length; i++) {
            this.items[i].draggable = false;

            this.items[i].setAttribute('data-href', this.items[i].getAttribute('href'));

            this.items[i].removeAttribute('href');
          }

          detached = true;
        }

        return this;
      },


      /**
       * Attaches anchors click events inside glide.
       *
       * @return {self}
       */
      attach: function attach() {
        prevented = false;

        if (detached) {
          for (var i = 0; i < this.items.length; i++) {
            this.items[i].draggable = true;

            this.items[i].setAttribute('href', this.items[i].getAttribute('data-href'));
          }

          detached = false;
        }

        return this;
      }
    };

    define(Anchors, 'items', {
      /**
       * Gets collection of the arrows HTML elements.
       *
       * @return {HTMLElement[]}
       */
      get: function get() {
        return Anchors._a;
      }
    });

    /**
     * Detach anchors inside slides:
     * - on swiping, so they won't redirect to its `href` attributes
     */
    Events.on('swipe.move', function () {
      Anchors.detach();
    });

    /**
     * Attach anchors inside slides:
     * - after swiping and transitions ends, so they can redirect after click again
     */
    Events.on('swipe.end', function () {
      Components.Transition.after(function () {
        Anchors.attach();
      });
    });

    /**
     * Unbind anchors inside slides:
     * - on destroying, to bring anchors to its initial state
     */
    Events.on('destroy', function () {
      Anchors.attach();
      Anchors.unbind();
      Binder.destroy();
    });

    return Anchors;
  }

  var NAV_SELECTOR = '[data-glide-el="controls[nav]"]';
  var CONTROLS_SELECTOR = '[data-glide-el^="controls"]';

  function Controls (Glide, Components, Events) {
    /**
     * Instance of the binder for DOM Events.
     *
     * @type {EventsBinder}
     */
    var Binder = new EventsBinder();

    var capture = supportsPassive$1 ? { passive: true } : false;

    var Controls = {
      /**
       * Inits arrows. Binds events listeners
       * to the arrows HTML elements.
       *
       * @return {Void}
       */
      mount: function mount() {
        /**
         * Collection of navigation HTML elements.
         *
         * @private
         * @type {HTMLCollection}
         */
        this._n = Components.Html.root.querySelectorAll(NAV_SELECTOR);

        /**
         * Collection of controls HTML elements.
         *
         * @private
         * @type {HTMLCollection}
         */
        this._c = Components.Html.root.querySelectorAll(CONTROLS_SELECTOR);

        this.addBindings();
      },


      /**
       * Sets active class to current slide.
       *
       * @return {Void}
       */
      setActive: function setActive() {
        for (var i = 0; i < this._n.length; i++) {
          this.addClass(this._n[i].children);
        }
      },


      /**
       * Removes active class to current slide.
       *
       * @return {Void}
       */
      removeActive: function removeActive() {
        for (var i = 0; i < this._n.length; i++) {
          this.removeClass(this._n[i].children);
        }
      },


      /**
       * Toggles active class on items inside navigation.
       *
       * @param  {HTMLElement} controls
       * @return {Void}
       */
      addClass: function addClass(controls) {
        var settings = Glide.settings;
        var item = controls[Glide.index];

        if (item) {
          item.classList.add(settings.classes.activeNav);

          siblings(item).forEach(function (sibling) {
            sibling.classList.remove(settings.classes.activeNav);
          });
        }
      },


      /**
       * Removes active class from active control.
       *
       * @param  {HTMLElement} controls
       * @return {Void}
       */
      removeClass: function removeClass(controls) {
        var item = controls[Glide.index];

        if (item) {
          item.classList.remove(Glide.settings.classes.activeNav);
        }
      },


      /**
       * Adds handles to the each group of controls.
       *
       * @return {Void}
       */
      addBindings: function addBindings() {
        for (var i = 0; i < this._c.length; i++) {
          this.bind(this._c[i].children);
        }
      },


      /**
       * Removes handles from the each group of controls.
       *
       * @return {Void}
       */
      removeBindings: function removeBindings() {
        for (var i = 0; i < this._c.length; i++) {
          this.unbind(this._c[i].children);
        }
      },


      /**
       * Binds events to arrows HTML elements.
       *
       * @param {HTMLCollection} elements
       * @return {Void}
       */
      bind: function bind(elements) {
        for (var i = 0; i < elements.length; i++) {
          Binder.on('click', elements[i], this.click);
          Binder.on('touchstart', elements[i], this.click, capture);
        }
      },


      /**
       * Unbinds events binded to the arrows HTML elements.
       *
       * @param {HTMLCollection} elements
       * @return {Void}
       */
      unbind: function unbind(elements) {
        for (var i = 0; i < elements.length; i++) {
          Binder.off(['click', 'touchstart'], elements[i]);
        }
      },


      /**
       * Handles `click` event on the arrows HTML elements.
       * Moves slider in driection precised in
       * `data-glide-dir` attribute.
       *
       * @param {Object} event
       * @return {Void}
       */
      click: function click(event) {
        event.preventDefault();

        Components.Run.make(Components.Direction.resolve(event.currentTarget.getAttribute('data-glide-dir')));
      }
    };

    define(Controls, 'items', {
      /**
       * Gets collection of the controls HTML elements.
       *
       * @return {HTMLElement[]}
       */
      get: function get() {
        return Controls._c;
      }
    });

    /**
     * Swap active class of current navigation item:
     * - after mounting to set it to initial index
     * - after each move to the new index
     */
    Events.on(['mount.after', 'move.after'], function () {
      Controls.setActive();
    });

    /**
     * Remove bindings and HTML Classes:
     * - on destroying, to bring markup to its initial state
     */
    Events.on('destroy', function () {
      Controls.removeBindings();
      Controls.removeActive();
      Binder.destroy();
    });

    return Controls;
  }

  function Keyboard (Glide, Components, Events) {
    /**
     * Instance of the binder for DOM Events.
     *
     * @type {EventsBinder}
     */
    var Binder = new EventsBinder();

    var Keyboard = {
      /**
       * Binds keyboard events on component mount.
       *
       * @return {Void}
       */
      mount: function mount() {
        if (Glide.settings.keyboard) {
          this.bind();
        }
      },


      /**
       * Adds keyboard press events.
       *
       * @return {Void}
       */
      bind: function bind() {
        Binder.on('keyup', document, this.press);
      },


      /**
       * Removes keyboard press events.
       *
       * @return {Void}
       */
      unbind: function unbind() {
        Binder.off('keyup', document);
      },


      /**
       * Handles keyboard's arrows press and moving glide foward and backward.
       *
       * @param  {Object} event
       * @return {Void}
       */
      press: function press(event) {
        if (event.keyCode === 39) {
          Components.Run.make(Components.Direction.resolve('>'));
        }

        if (event.keyCode === 37) {
          Components.Run.make(Components.Direction.resolve('<'));
        }
      }
    };

    /**
     * Remove bindings from keyboard:
     * - on destroying to remove added events
     * - on updating to remove events before remounting
     */
    Events.on(['destroy', 'update'], function () {
      Keyboard.unbind();
    });

    /**
     * Remount component
     * - on updating to reflect potential changes in settings
     */
    Events.on('update', function () {
      Keyboard.mount();
    });

    /**
     * Destroy binder:
     * - on destroying to remove listeners
     */
    Events.on('destroy', function () {
      Binder.destroy();
    });

    return Keyboard;
  }

  function Autoplay (Glide, Components, Events) {
    /**
     * Instance of the binder for DOM Events.
     *
     * @type {EventsBinder}
     */
    var Binder = new EventsBinder();

    var Autoplay = {
      /**
       * Initializes autoplaying and events.
       *
       * @return {Void}
       */
      mount: function mount() {
        this.start();

        if (Glide.settings.hoverpause) {
          this.bind();
        }
      },


      /**
       * Starts autoplaying in configured interval.
       *
       * @param {Boolean|Number} force Run autoplaying with passed interval regardless of `autoplay` settings
       * @return {Void}
       */
      start: function start() {
        var _this = this;

        if (Glide.settings.autoplay) {
          if (isUndefined(this._i)) {
            this._i = setInterval(function () {
              _this.stop();

              Components.Run.make('>');

              _this.start();
            }, this.time);
          }
        }
      },


      /**
       * Stops autorunning of the glide.
       *
       * @return {Void}
       */
      stop: function stop() {
        this._i = clearInterval(this._i);
      },


      /**
       * Stops autoplaying while mouse is over glide's area.
       *
       * @return {Void}
       */
      bind: function bind() {
        var _this2 = this;

        Binder.on('mouseover', Components.Html.root, function () {
          _this2.stop();
        });

        Binder.on('mouseout', Components.Html.root, function () {
          _this2.start();
        });
      },


      /**
       * Unbind mouseover events.
       *
       * @returns {Void}
       */
      unbind: function unbind() {
        Binder.off(['mouseover', 'mouseout'], Components.Html.root);
      }
    };

    define(Autoplay, 'time', {
      /**
       * Gets time period value for the autoplay interval. Prioritizes
       * times in `data-glide-autoplay` attrubutes over options.
       *
       * @return {Number}
       */
      get: function get() {
        var autoplay = Components.Html.slides[Glide.index].getAttribute('data-glide-autoplay');

        if (autoplay) {
          return toInt(autoplay);
        }

        return toInt(Glide.settings.autoplay);
      }
    });

    /**
     * Stop autoplaying and unbind events:
     * - on destroying, to clear defined interval
     * - on updating via API to reset interval that may changed
     */
    Events.on(['destroy', 'update'], function () {
      Autoplay.unbind();
    });

    /**
     * Stop autoplaying:
     * - before each run, to restart autoplaying
     * - on pausing via API
     * - on destroying, to clear defined interval
     * - while starting a swipe
     * - on updating via API to reset interval that may changed
     */
    Events.on(['run.before', 'pause', 'destroy', 'swipe.start', 'update'], function () {
      Autoplay.stop();
    });

    /**
     * Start autoplaying:
     * - after each run, to restart autoplaying
     * - on playing via API
     * - while ending a swipe
     */
    Events.on(['run.after', 'play', 'swipe.end'], function () {
      Autoplay.start();
    });

    /**
     * Remount autoplaying:
     * - on updating via API to reset interval that may changed
     */
    Events.on('update', function () {
      Autoplay.mount();
    });

    /**
     * Destroy a binder:
     * - on destroying glide instance to clearup listeners
     */
    Events.on('destroy', function () {
      Binder.destroy();
    });

    return Autoplay;
  }

  /**
   * Sorts keys of breakpoint object so they will be ordered from lower to bigger.
   *
   * @param {Object} points
   * @returns {Object}
   */
  function sortBreakpoints(points) {
    if (isObject(points)) {
      return sortKeys(points);
    } else {
      warn('Breakpoints option must be an object');
    }

    return {};
  }

  function Breakpoints (Glide, Components, Events) {
    /**
     * Instance of the binder for DOM Events.
     *
     * @type {EventsBinder}
     */
    var Binder = new EventsBinder();

    /**
     * Holds reference to settings.
     *
     * @type {Object}
     */
    var settings = Glide.settings;

    /**
     * Holds reference to breakpoints object in settings. Sorts breakpoints
     * from smaller to larger. It is required in order to proper
     * matching currently active breakpoint settings.
     *
     * @type {Object}
     */
    var points = sortBreakpoints(settings.breakpoints);

    /**
     * Cache initial settings before overwritting.
     *
     * @type {Object}
     */
    var defaults = _extends({}, settings);

    var Breakpoints = {
      /**
       * Matches settings for currectly matching media breakpoint.
       *
       * @param {Object} points
       * @returns {Object}
       */
      match: function match(points) {
        if (typeof window.matchMedia !== 'undefined') {
          for (var point in points) {
            if (points.hasOwnProperty(point)) {
              if (window.matchMedia('(max-width: ' + point + 'px)').matches) {
                return points[point];
              }
            }
          }
        }

        return defaults;
      }
    };

    /**
     * Overwrite instance settings with currently matching breakpoint settings.
     * This happens right after component initialization.
     */
    _extends(settings, Breakpoints.match(points));

    /**
     * Update glide with settings of matched brekpoint:
     * - window resize to update slider
     */
    Binder.on('resize', window, throttle(function () {
      Glide.settings = mergeOptions(settings, Breakpoints.match(points));
    }, Glide.settings.throttle));

    /**
     * Resort and update default settings:
     * - on reinit via API, so breakpoint matching will be performed with options
     */
    Events.on('update', function () {
      points = sortBreakpoints(points);

      defaults = _extends({}, settings);
    });

    /**
     * Unbind resize listener:
     * - on destroying, to bring markup to its initial state
     */
    Events.on('destroy', function () {
      Binder.off('resize', window);
    });

    return Breakpoints;
  }

  var COMPONENTS = {
    // Required
    Html: Html,
    Translate: Translate,
    Transition: Transition,
    Direction: Direction,
    Peek: Peek,
    Sizes: Sizes,
    Gaps: Gaps,
    Move: Move,
    Clones: Clones,
    Resize: Resize,
    Build: Build,
    Run: Run,

    // Optional
    Swipe: Swipe,
    Images: Images,
    Anchors: Anchors,
    Controls: Controls,
    Keyboard: Keyboard,
    Autoplay: Autoplay,
    Breakpoints: Breakpoints
  };

  var Glide$1 = function (_Core) {
    inherits(Glide$$1, _Core);

    function Glide$$1() {
      classCallCheck(this, Glide$$1);
      return possibleConstructorReturn(this, (Glide$$1.__proto__ || Object.getPrototypeOf(Glide$$1)).apply(this, arguments));
    }

    createClass(Glide$$1, [{
      key: 'mount',
      value: function mount() {
        var extensions = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : {};

        return get(Glide$$1.prototype.__proto__ || Object.getPrototypeOf(Glide$$1.prototype), 'mount', this).call(this, _extends({}, COMPONENTS, extensions));
      }
    }]);
    return Glide$$1;
  }(Glide);

  return Glide$1;

})));

/*! hyperform.js.org */
'use strict';

/* the following code is borrowed from the WebComponents project, licensed
 * under the BSD license. Source:
 * <https://github.com/webcomponents/webcomponentsjs/blob/5283db1459fa2323e5bfc8b9b5cc1753ed85e3d0/src/WebComponents/dom.js#L53-L78>
 */
// defaultPrevented is broken in IE.
// https://connect.microsoft.com/IE/feedback/details/790389/event-defaultprevented-returns-false-after-preventdefault-was-called

var workingDefaultPrevented = function () {
  var e = document.createEvent('Event');
  e.initEvent('foo', true, true);
  e.preventDefault();
  return e.defaultPrevented;
}();

if (!workingDefaultPrevented) {
  (function () {
    var origPreventDefault = window.Event.prototype.preventDefault;
    window.Event.prototype.preventDefault = function () {
      if (!this.cancelable) {
        return;
      }

      origPreventDefault.call(this);

      Object.defineProperty(this, 'defaultPrevented', {
        get: function get() {
          return true;
        },
        configurable: true
      });
    };
  })();
}
/* end of borrowed code */

function create_event(name) {
  var _ref = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : {};

  var _ref$bubbles = _ref.bubbles;
  var bubbles = _ref$bubbles === undefined ? true : _ref$bubbles;
  var _ref$cancelable = _ref.cancelable;
  var cancelable = _ref$cancelable === undefined ? false : _ref$cancelable;

  var event = document.createEvent('Event');
  event.initEvent(name, bubbles, cancelable);
  return event;
}

function trigger_event (element, event) {
  var _ref2 = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : {};

  var _ref2$bubbles = _ref2.bubbles;
  var bubbles = _ref2$bubbles === undefined ? true : _ref2$bubbles;
  var _ref2$cancelable = _ref2.cancelable;
  var cancelable = _ref2$cancelable === undefined ? false : _ref2$cancelable;
  var payload = arguments.length > 3 && arguments[3] !== undefined ? arguments[3] : {};

  if (!(event instanceof window.Event)) {
    event = create_event(event, { bubbles: bubbles, cancelable: cancelable });
  }

  for (var key in payload) {
    if (payload.hasOwnProperty(key)) {
      event[key] = payload[key];
    }
  }

  element.dispatchEvent(event);

  return event;
}

/* shim layer for the Element.matches method */

var ep = window.Element.prototype;
var native_matches = ep.matches || ep.matchesSelector || ep.msMatchesSelector || ep.webkitMatchesSelector;

function matches (element, selector) {
                       return native_matches.call(element, selector);
}

/**
 * mark an object with a '__hyperform=true' property
 *
 * We use this to distinguish our properties from the native ones. Usage:
 * js> mark(obj);
 * js> assert(obj.__hyperform === true)
 */

function mark (obj) {
  if (['object', 'function'].indexOf(typeof obj) > -1) {
    delete obj.__hyperform;
    Object.defineProperty(obj, '__hyperform', {
      configurable: true,
      enumerable: false,
      value: true
    });
  }

  return obj;
}

/**
 * the internal storage for messages
 */
var store = new WeakMap();

/* jshint -W053 */ /* allow new String() */
/**
 * handle validation messages
 *
 * Falls back to browser-native errors, if any are available. The messages
 * are String objects so that we can mark() them.
 */
var message_store = {
  set: function set(element, message) {
    var is_custom = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : false;

    if (element instanceof window.HTMLFieldSetElement) {
      var wrapped_form = get_wrapper(element);
      if (wrapped_form && !wrapped_form.settings.extendFieldset) {
        /* make this a no-op for <fieldset> in strict mode */
        return message_store;
      }
    }

    if (typeof message === 'string') {
      message = new String(message);
    }
    if (is_custom) {
      message.is_custom = true;
    }
    mark(message);
    store.set(element, message);

    /* allow the :invalid selector to match */
    if ('_original_setCustomValidity' in element) {
      element._original_setCustomValidity(message.toString());
    }

    return message_store;
  },
  get: function get(element) {
    var message = store.get(element);
    if (message === undefined && '_original_validationMessage' in element) {
      /* get the browser's validation message, if we have none. Maybe it
       * knows more than we. */
      message = new String(element._original_validationMessage);
    }
    return message ? message : new String('');
  },
  delete: function _delete(element) {
    var is_custom = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : false;

    if ('_original_setCustomValidity' in element) {
      element._original_setCustomValidity('');
    }
    var message = store.get(element);
    if (message && is_custom && !message.is_custom) {
      /* do not delete "native" messages, if asked */
      return false;
    }
    return store.delete(element);
  }
};

/**
 * counter that will be incremented with every call
 *
 * Will enforce uniqueness, as long as no more than 1 hyperform scripts
 * are loaded. (In that case we still have the "random" part below.)
 */

var uid = 0;

/**
 * generate a random ID
 *
 * @see https://gist.github.com/gordonbrander/2230317
 */
function generate_id () {
  var prefix = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : 'hf_';

  return prefix + uid++ + Math.random().toString(36).substr(2);
}

/**
 * get all radio buttons (including `element`) that belong to element's
 * radio group
 */

function get_radiogroup(element) {
  if (element.form) {
    return Array.prototype.filter.call(element.form.elements, function (radio) {
      return radio.type === 'radio' && radio.name === element.name;
    });
  }
  return [element];
}

var warningsCache = new WeakMap();

var DefaultRenderer = {

  /**
   * called when a warning should become visible
   */
  attachWarning: function attachWarning(warning, element) {
    /* should also work, if element is last,
     * http://stackoverflow.com/a/4793630/113195 */
    element.parentNode.insertBefore(warning, element.nextSibling);
  },

  /**
   * called when a warning should vanish
   */
  detachWarning: function detachWarning(warning, element) {
    /* be conservative here, since an overwritten attachWarning() might not
     * actually have attached the warning. */
    if (warning.parentNode) {
      warning.parentNode.removeChild(warning);
    }
  },

  /**
   * called when feedback to an element's state should be handled
   *
   * i.e., showing and hiding warnings
   */
  showWarning: function showWarning(element) {
    var whole_form_validated = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : false;

    /* don't render error messages on subsequent radio buttons of the
     * same group. This assumes, that element.validity.valueMissing is the only
     * possible validation failure for radio buttons. */
    if (whole_form_validated && element.type === 'radio' && get_radiogroup(element)[0] !== element) {
      return;
    }

    var msg = message_store.get(element).toString();
    var warning = warningsCache.get(element);

    if (msg) {
      if (!warning) {
        var wrapper = get_wrapper(element);
        warning = document.createElement('div');
        warning.className = wrapper && wrapper.settings.classes.warning || 'hf-warning';
        warning.id = generate_id();
        warning.setAttribute('aria-live', 'polite');
        warningsCache.set(element, warning);
      }

      element.setAttribute('aria-errormessage', warning.id);
      if (!element.hasAttribute('aria-describedby')) {
        element.setAttribute('aria-describedby', warning.id);
      }
      Renderer.setMessage(warning, msg, element);
      Renderer.attachWarning(warning, element);
    } else if (warning && warning.parentNode) {
      if (element.getAttribute('aria-describedby') === warning.id) {
        element.removeAttribute('aria-describedby');
      }
      element.removeAttribute('aria-errormessage');
      Renderer.detachWarning(warning, element);
    }
  },

  /**
   * set the warning's content
   *
   * Overwrite this method, if you want, e.g., to allow HTML in warnings
   * or preprocess the content.
   */
  setMessage: function setMessage(warning, message, element) {
    warning.textContent = message;
  }

};

var Renderer = {

  attachWarning: DefaultRenderer.attachWarning,
  detachWarning: DefaultRenderer.detachWarning,
  showWarning: DefaultRenderer.showWarning,
  setMessage: DefaultRenderer.setMessage,

  set: function set(renderer, action) {
    if (renderer.indexOf('_') > -1) {
      /* global console */
      // TODO delete before next non-patch version
      console.log('Renderer.set: please use camelCase names. ' + renderer + ' will be removed in the next non-patch release.');
      renderer = renderer.replace(/_([a-z])/g, function (g) {
        return g[1].toUpperCase();
      });
    }
    if (!action) {
      action = DefaultRenderer[renderer];
    }
    Renderer[renderer] = action;
  },

  getWarning: function getWarning(element) {
    return warningsCache.get(element);
  }

};

var registry = Object.create(null);

/**
 * run all actions registered for a hook
 *
 * Every action gets called with a state object as `this` argument and with the
 * hook's call arguments as call arguments.
 *
 * @return mixed the returned value of the action calls or undefined
 */
function call_hook(hook) {
  var result;
  var call_args = Array.prototype.slice.call(arguments, 1);

  if (hook in registry) {
    result = registry[hook].reduce(function (args) {

      return function (previousResult, currentAction) {
        var interimResult = currentAction.apply({
          state: previousResult,
          hook: hook
        }, args);
        return interimResult !== undefined ? interimResult : previousResult;
      };
    }(call_args), result);
  }

  return result;
}

/**
 * Filter a value through hooked functions
 *
 * Allows for additional parameters:
 * js> do_filter('foo', null, current_element)
 */
function do_filter(hook, initial_value) {
  var result = initial_value;
  var call_args = Array.prototype.slice.call(arguments, 1);

  if (hook in registry) {
    result = registry[hook].reduce(function (previousResult, currentAction) {
      call_args[0] = previousResult;
      var interimResult = currentAction.apply({
        state: previousResult,
        hook: hook
      }, call_args);
      return interimResult !== undefined ? interimResult : previousResult;
    }, result);
  }

  return result;
}

/**
 * remove an action again
 */
function remove_hook(hook, action) {
  if (hook in registry) {
    for (var i = 0; i < registry[hook].length; i++) {
      if (registry[hook][i] === action) {
        registry[hook].splice(i, 1);
        break;
      }
    }
  }
}
/**
 * add an action to a hook
 */
function add_hook(hook, action, position) {
  if (!(hook in registry)) {
    registry[hook] = [];
  }
  if (position === undefined) {
    position = registry[hook].length;
  }
  registry[hook].splice(position, 0, action);
}

/* and datetime-local? Spec says “Nah!” */

var dates = ['datetime', 'date', 'month', 'week', 'time'];

var plain_numbers = ['number', 'range'];

/* everything that returns something meaningful for valueAsNumber and
 * can have the step attribute */
var numbers = dates.concat(plain_numbers, 'datetime-local');

/* the spec says to only check those for syntax in validity.typeMismatch.
 * ¯\_(ツ)_/¯ */
var type_checked = ['email', 'url'];

/* check these for validity.badInput */
var input_checked = ['email', 'date', 'month', 'week', 'time', 'datetime', 'datetime-local', 'number', 'range', 'color'];

var text_types = ['text', 'search', 'tel', 'password'].concat(type_checked);

/* input element types, that are candidates for the validation API.
 * Missing from this set are: button, hidden, menu (from <button>), reset and
 * the types for non-<input> elements. */
var validation_candidates = ['checkbox', 'color', 'file', 'image', 'radio', 'submit'].concat(numbers, text_types);

/* all known types of <input> */
var inputs = ['button', 'hidden', 'reset'].concat(validation_candidates);

/* apparently <select> and <textarea> have types of their own */
var non_inputs = ['select-one', 'select-multiple', 'textarea'];

/**
 * get the element's type in a backwards-compatible way
 */
function get_type (element) {
  if (element instanceof window.HTMLTextAreaElement) {
    return 'textarea';
  } else if (element instanceof window.HTMLSelectElement) {
    return element.hasAttribute('multiple') ? 'select-multiple' : 'select-one';
  } else if (element instanceof window.HTMLButtonElement) {
    return (element.getAttribute('type') || 'submit').toLowerCase();
  } else if (element instanceof window.HTMLInputElement) {
    var attr = (element.getAttribute('type') || '').toLowerCase();
    if (attr && inputs.indexOf(attr) > -1) {
      return attr;
    } else {
      /* perhaps the DOM has in-depth knowledge. Take that before returning
       * 'text'. */
      return element.type || 'text';
    }
  }

  return '';
}

/**
 * check if an element should be ignored due to any of its parents
 *
 * Checks <fieldset disabled> and <datalist>.
 */
function is_in_disallowed_parent(element) {
  var p = element.parentNode;
  while (p && p.nodeType === 1) {
    if (p instanceof window.HTMLFieldSetElement && p.hasAttribute('disabled')) {
      /* quick return, if it's a child of a disabled fieldset */
      return true;
    } else if (p.nodeName.toUpperCase() === 'DATALIST') {
      /* quick return, if it's a child of a datalist
       * Do not use HTMLDataListElement to support older browsers,
       * too.
       * @see https://html.spec.whatwg.org/multipage/forms.html#the-datalist-element:barred-from-constraint-validation
       */
      return true;
    } else if (p === element.form) {
      /* the outer boundary. We can stop looking for relevant elements. */
      break;
    }
    p = p.parentNode;
  }
  return false;
}

/**
 * check if an element is a candidate for constraint validation
 *
 * @see https://html.spec.whatwg.org/multipage/forms.html#barred-from-constraint-validation
 */
function is_validation_candidate (element) {

  /* allow a shortcut via filters, e.g. to validate type=hidden fields */
  var filtered = do_filter('is_validation_candidate', null, element);
  if (filtered !== null) {
    return !!filtered;
  }

  /* it must be any of those elements */
  if (element instanceof window.HTMLSelectElement || element instanceof window.HTMLTextAreaElement || element instanceof window.HTMLButtonElement || element instanceof window.HTMLInputElement) {

    var type = get_type(element);
    /* its type must be in the whitelist */
    if (non_inputs.indexOf(type) > -1 || validation_candidates.indexOf(type) > -1) {

      /* it mustn't be disabled or readonly */
      if (!element.hasAttribute('disabled') && !element.hasAttribute('readonly')) {

        var wrapped_form = get_wrapper(element);

        if (
        /* the parent form doesn't allow non-standard "novalidate" attributes... */
        wrapped_form && !wrapped_form.settings.novalidateOnElements ||
        /* ...or it doesn't have such an attribute/property */
        !element.hasAttribute('novalidate') && !element.noValidate) {

          /* it isn't part of a <fieldset disabled> */
          if (!is_in_disallowed_parent(element)) {

            /* then it's a candidate */
            return true;
          }
        }
      }
    }
  }

  /* this is no HTML5 validation candidate... */
  return false;
}

function format_date (date) {
  var part = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : undefined;

  switch (part) {
    case 'date':
      return (date.toLocaleDateString || date.toDateString).call(date);
    case 'time':
      return (date.toLocaleTimeString || date.toTimeString).call(date);
    case 'month':
      return 'toLocaleDateString' in date ? date.toLocaleDateString(undefined, {
        year: 'numeric',
        month: '2-digit'
      }) : date.toDateString();
    // case 'week':
    // TODO
    default:
      return (date.toLocaleString || date.toString).call(date);
  }
}

function sprintf (str) {
  for (var _len = arguments.length, args = Array(_len > 1 ? _len - 1 : 0), _key = 1; _key < _len; _key++) {
    args[_key - 1] = arguments[_key];
  }

  var args_length = args.length;
  var global_index = 0;

  return str.replace(/%([0-9]+\$)?([sl])/g, function (match, position, type) {
    var local_index = global_index;
    if (position) {
      local_index = Number(position.replace(/\$$/, '')) - 1;
    }
    global_index += 1;

    var arg = '';
    if (args_length > local_index) {
      arg = args[local_index];
    }

    if (arg instanceof Date || typeof arg === 'number' || arg instanceof Number) {
      /* try getting a localized representation of dates and numbers, if the
       * browser supports this */
      if (type === 'l') {
        arg = (arg.toLocaleString || arg.toString).call(arg);
      } else {
        arg = arg.toString();
      }
    }

    return arg;
  });
}

/* For a given date, get the ISO week number
 *
 * Source: http://stackoverflow.com/a/6117889/113195
 *
 * Based on information at:
 *
 *    http://www.merlyn.demon.co.uk/weekcalc.htm#WNR
 *
 * Algorithm is to find nearest thursday, it's year
 * is the year of the week number. Then get weeks
 * between that date and the first day of that year.
 *
 * Note that dates in one year can be weeks of previous
 * or next year, overlap is up to 3 days.
 *
 * e.g. 2014/12/29 is Monday in week  1 of 2015
 *      2012/1/1   is Sunday in week 52 of 2011
 */

function get_week_of_year (d) {
  /* Copy date so don't modify original */
  d = new Date(+d);
  d.setUTCHours(0, 0, 0);
  /* Set to nearest Thursday: current date + 4 - current day number
   * Make Sunday's day number 7 */
  d.setUTCDate(d.getUTCDate() + 4 - (d.getUTCDay() || 7));
  /* Get first day of year */
  var yearStart = new Date(d.getUTCFullYear(), 0, 1);
  /* Calculate full weeks to nearest Thursday */
  var weekNo = Math.ceil(((d - yearStart) / 86400000 + 1) / 7);
  /* Return array of year and week number */
  return [d.getUTCFullYear(), weekNo];
}

function pad(num) {
  var size = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 2;

  var s = num + '';
  while (s.length < size) {
    s = '0' + s;
  }
  return s;
}

/**
 * calculate a string from a date according to HTML5
 */
function date_to_string(date, element_type) {
  if (!(date instanceof Date)) {
    return null;
  }

  switch (element_type) {
    case 'datetime':
      return date_to_string(date, 'date') + 'T' + date_to_string(date, 'time');

    case 'datetime-local':
      return sprintf('%s-%s-%sT%s:%s:%s.%s', date.getFullYear(), pad(date.getMonth() + 1), pad(date.getDate()), pad(date.getHours()), pad(date.getMinutes()), pad(date.getSeconds()), pad(date.getMilliseconds(), 3)).replace(/(:00)?\.000$/, '');

    case 'date':
      return sprintf('%s-%s-%s', date.getUTCFullYear(), pad(date.getUTCMonth() + 1), pad(date.getUTCDate()));

    case 'month':
      return sprintf('%s-%s', date.getUTCFullYear(), pad(date.getUTCMonth() + 1));

    case 'week':
      var params = get_week_of_year(date);
      return sprintf.call(null, '%s-W%s', params[0], pad(params[1]));

    case 'time':
      return sprintf('%s:%s:%s.%s', pad(date.getUTCHours()), pad(date.getUTCMinutes()), pad(date.getUTCSeconds()), pad(date.getUTCMilliseconds(), 3)).replace(/(:00)?\.000$/, '');
  }

  return null;
}

/**
 * return a new Date() representing the ISO date for a week number
 *
 * @see http://stackoverflow.com/a/16591175/113195
 */

function get_date_from_week (week, year) {
  var date = new Date(Date.UTC(year, 0, 1 + (week - 1) * 7));

  if (date.getUTCDay() <= 4 /* thursday */) {
      date.setUTCDate(date.getUTCDate() - date.getUTCDay() + 1);
    } else {
    date.setUTCDate(date.getUTCDate() + 8 - date.getUTCDay());
  }

  return date;
}

/**
 * calculate a date from a string according to HTML5
 */
function string_to_date (string, element_type) {
  var date = void 0;
  switch (element_type) {
    case 'datetime':
      if (!/^([0-9]{4})-(0[1-9]|1[012])-(0[1-9]|[12][0-9]|3[01])T([01][0-9]|2[0-3]):([0-5][0-9])(?::([0-5][0-9])(?:\.([0-9]{1,3}))?)?$/.test(string)) {
        return null;
      }
      date = new Date(string + 'z');
      return isNaN(date.valueOf()) ? null : date;

    case 'date':
      if (!/^([0-9]{4})-(0[1-9]|1[012])-(0[1-9]|[12][0-9]|3[01])$/.test(string)) {
        return null;
      }
      date = new Date(string);
      return isNaN(date.valueOf()) ? null : date;

    case 'month':
      if (!/^([0-9]{4})-(0[1-9]|1[012])$/.test(string)) {
        return null;
      }
      date = new Date(string);
      return isNaN(date.valueOf()) ? null : date;

    case 'week':
      if (!/^([0-9]{4})-W(0[1-9]|[1234][0-9]|5[0-3])$/.test(string)) {
        return null;
      }
      return get_date_from_week(Number(RegExp.$2), Number(RegExp.$1));

    case 'time':
      if (!/^([01][0-9]|2[0-3]):([0-5][0-9])(?::([0-5][0-9])(?:\.([0-9]{1,3}))?)?$/.test(string)) {
        return null;
      }
      date = new Date('1970-01-01T' + string + 'z');
      return date;
  }

  return null;
}

/**
 * calculate a number from a string according to HTML5
 */
function string_to_number (string, element_type) {
  var rval = string_to_date(string, element_type);
  if (rval !== null) {
    return +rval;
  }
  /* not parseFloat, because we want NaN for invalid values like "1.2xxy" */
  return Number(string);
}

/**
 * the following validation messages are from Firefox source,
 * http://mxr.mozilla.org/mozilla-central/source/dom/locales/en-US/chrome/dom/dom.properties
 * released under MPL license, http://mozilla.org/MPL/2.0/.
 */

var catalog = {
  en: {
    TextTooLong: 'Please shorten this text to %l characters or less (you are currently using %l characters).',
    ValueMissing: 'Please fill out this field.',
    CheckboxMissing: 'Please check this box if you want to proceed.',
    RadioMissing: 'Please select one of these options.',
    FileMissing: 'Please select a file.',
    SelectMissing: 'Please select an item in the list.',
    InvalidEmail: 'Please enter an email address.',
    InvalidURL: 'Please enter a URL.',
    PatternMismatch: 'Please match the requested format.',
    PatternMismatchWithTitle: 'Please match the requested format: %l.',
    NumberRangeOverflow: 'Please select a value that is no more than %l.',
    DateRangeOverflow: 'Please select a value that is no later than %l.',
    TimeRangeOverflow: 'Please select a value that is no later than %l.',
    NumberRangeUnderflow: 'Please select a value that is no less than %l.',
    DateRangeUnderflow: 'Please select a value that is no earlier than %l.',
    TimeRangeUnderflow: 'Please select a value that is no earlier than %l.',
    StepMismatch: 'Please select a valid value. The two nearest valid values are %l and %l.',
    StepMismatchOneValue: 'Please select a valid value. The nearest valid value is %l.',
    BadInputNumber: 'Please enter a number.'
  }
};

/**
 * the global language Hyperform will use
 */
var language = 'en';

/**
 * the base language according to BCP47, i.e., only the piece before the first hyphen
 */
var base_lang = 'en';

/**
 * set the language for Hyperform’s messages
 */
function set_language(newlang) {
  language = newlang;
  base_lang = newlang.replace(/[-_].*/, '');
}

/**
 * add a lookup catalog "string: translation" for a language
 */
function add_translation(lang, new_catalog) {
  if (!(lang in catalog)) {
    catalog[lang] = {};
  }
  for (var key in new_catalog) {
    if (new_catalog.hasOwnProperty(key)) {
      catalog[lang][key] = new_catalog[key];
    }
  }
}

/**
 * return `s` translated into the current language
 *
 * Defaults to the base language and then English if the former has no
 * translation for `s`.
 */
function _ (s) {
  if (language in catalog && s in catalog[language]) {
    return catalog[language][s];
  } else if (base_lang in catalog && s in catalog[base_lang]) {
    return catalog[base_lang][s];
  } else if (s in catalog.en) {
    return catalog.en[s];
  }
  return s;
}

var default_step = {
  'datetime-local': 60,
  datetime: 60,
  time: 60
};

var step_scale_factor = {
  'datetime-local': 1000,
  datetime: 1000,
  date: 86400000,
  week: 604800000,
  time: 1000
};

var default_step_base = {
  week: -259200000
};

var default_min = {
  range: 0
};

var default_max = {
  range: 100
};

/**
 * get previous and next valid values for a stepped input element
 */
function get_next_valid (element) {
  var n = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 1;

  var type = get_type(element);

  var aMin = element.getAttribute('min');
  var min = default_min[type] || NaN;
  if (aMin) {
    var pMin = string_to_number(aMin, type);
    if (!isNaN(pMin)) {
      min = pMin;
    }
  }

  var aMax = element.getAttribute('max');
  var max = default_max[type] || NaN;
  if (aMax) {
    var pMax = string_to_number(aMax, type);
    if (!isNaN(pMax)) {
      max = pMax;
    }
  }

  var aStep = element.getAttribute('step');
  var step = default_step[type] || 1;
  if (aStep && aStep.toLowerCase() === 'any') {
    /* quick return: we cannot calculate prev and next */
    return [_('any value'), _('any value')];
  } else if (aStep) {
    var pStep = string_to_number(aStep, type);
    if (!isNaN(pStep)) {
      step = pStep;
    }
  }

  var default_value = string_to_number(element.getAttribute('value'), type);

  var value = string_to_number(element.value || element.getAttribute('value'), type);

  if (isNaN(value)) {
    /* quick return: we cannot calculate without a solid base */
    return [_('any valid value'), _('any valid value')];
  }

  var step_base = !isNaN(min) ? min : !isNaN(default_value) ? default_value : default_step_base[type] || 0;

  var scale = step_scale_factor[type] || 1;

  var prev = step_base + Math.floor((value - step_base) / (step * scale)) * (step * scale) * n;
  var next = step_base + (Math.floor((value - step_base) / (step * scale)) + 1) * (step * scale) * n;

  if (prev < min) {
    prev = null;
  } else if (prev > max) {
    prev = max;
  }

  if (next > max) {
    next = null;
  } else if (next < min) {
    next = min;
  }

  /* convert to date objects, if appropriate */
  if (dates.indexOf(type) > -1) {
    prev = date_to_string(new Date(prev), type);
    next = date_to_string(new Date(next), type);
  }

  return [prev, next];
}

/**
 * patch String.length to account for non-BMP characters
 *
 * @see https://mathiasbynens.be/notes/javascript-unicode
 * We do not use the simple [...str].length, because it needs a ton of
 * polyfills in older browsers.
 */

function unicode_string_length (str) {
  return str.match(/[\0-\uD7FF\uE000-\uFFFF]|[\uD800-\uDBFF][\uDC00-\uDFFF]|[\uD800-\uDBFF](?![\uDC00-\uDFFF])|(?:[^\uD800-\uDBFF]|^)[\uDC00-\uDFFF]/g).length;
}

/**
 * internal storage for custom error messages
 */

var store$1 = new WeakMap();

/**
 * register custom error messages per element
 */
var custom_messages = {
  set: function set(element, validator, message) {
    var messages = store$1.get(element) || {};
    messages[validator] = message;
    store$1.set(element, messages);
    return custom_messages;
  },
  get: function get(element, validator) {
    var _default = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : undefined;

    var messages = store$1.get(element);
    if (messages === undefined || !(validator in messages)) {
      var data_id = 'data-' + validator.replace(/[A-Z]/g, '-$&').toLowerCase();
      if (element.hasAttribute(data_id)) {
        /* if the element has a data-validator attribute, use this as fallback.
         * E.g., if validator == 'valueMissing', the element can specify a
         * custom validation message like this:
         *     <input data-value-missing="Oh noes!">
         */
        return element.getAttribute(data_id);
      }
      return _default;
    }
    return messages[validator];
  },
  delete: function _delete(element) {
    var validator = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : null;

    if (!validator) {
      return store$1.delete(element);
    }
    var messages = store$1.get(element) || {};
    if (validator in messages) {
      delete messages[validator];
      store$1.set(element, messages);
      return true;
    }
    return false;
  }
};

var internal_registry = new WeakMap();

/**
 * A registry for custom validators
 *
 * slim wrapper around a WeakMap to ensure the values are arrays
 * (hence allowing > 1 validators per element)
 */
var custom_validator_registry = {
  set: function set(element, validator) {
    var current = internal_registry.get(element) || [];
    current.push(validator);
    internal_registry.set(element, current);
    return custom_validator_registry;
  },
  get: function get(element) {
    return internal_registry.get(element) || [];
  },
  delete: function _delete(element) {
    return internal_registry.delete(element);
  }
};

/**
 * test whether the element suffers from bad input
 */
function test_bad_input (element) {
  var type = get_type(element);

  if (input_checked.indexOf(type) === -1) {
    /* we're not interested, thanks! */
    return true;
  }

  /* the browser hides some bad input from the DOM, e.g. malformed numbers,
   * email addresses with invalid punycode representation, ... We try to resort
   * to the original method here. The assumption is, that a browser hiding
   * bad input will hopefully also always support a proper
   * ValidityState.badInput */
  if (!element.value) {
    if ('_original_validity' in element && !element._original_validity.__hyperform) {
      return !element._original_validity.badInput;
    }
    /* no value and no original badInput: Assume all's right. */
    return true;
  }

  var result = true;
  switch (type) {
    case 'color':
      result = /^#[a-f0-9]{6}$/.test(element.value);
      break;
    case 'number':
    case 'range':
      result = !isNaN(Number(element.value));
      break;
    case 'datetime':
    case 'date':
    case 'month':
    case 'week':
    case 'time':
      result = string_to_date(element.value, type) !== null;
      break;
    case 'datetime-local':
      result = /^([0-9]{4,})-(0[1-9]|1[012])-(0[1-9]|[12][0-9]|3[01])T([01][0-9]|2[0-3]):([0-5][0-9])(?::([0-5][0-9])(?:\.([0-9]{1,3}))?)?$/.test(element.value);
      break;
    case 'tel':
      /* spec says No! Phone numbers can have all kinds of formats, so this
       * is expected to be a free-text field. */
      // TODO we could allow a setting 'phone_regex' to be evaluated here.
      break;
    case 'email':
      break;
  }

  return result;
}

/**
 * test the max attribute
 *
 * we use Number() instead of parseFloat(), because an invalid attribute
 * value like "123abc" should result in an error.
 */
function test_max (element) {
  var type = get_type(element);

  if (!element.value || !element.hasAttribute('max')) {
    /* we're not responsible here */
    return true;
  }

  var value = void 0,
      max = void 0;
  if (dates.indexOf(type) > -1) {
    value = string_to_date(element.value, type);
    value = value === null ? NaN : +value;
    max = string_to_date(element.getAttribute('max'), type);
    max = max === null ? NaN : +max;
  } else {
    value = Number(element.value);
    max = Number(element.getAttribute('max'));
  }

  /* we cannot validate invalid values and trust on badInput, if isNaN(value) */
  return isNaN(max) || isNaN(value) || value <= max;
}

/**
 * test the maxlength attribute
 */
function test_maxlength (element) {
  if (!element.value || text_types.indexOf(get_type(element)) === -1 || !element.hasAttribute('maxlength') || !element.getAttribute('maxlength') // catch maxlength=""
  ) {
      return true;
    }

  var maxlength = parseInt(element.getAttribute('maxlength'), 10);

  /* check, if the maxlength value is usable at all.
   * We allow maxlength === 0 to basically disable input (Firefox does, too).
   */
  if (isNaN(maxlength) || maxlength < 0) {
    return true;
  }

  return unicode_string_length(element.value) <= maxlength;
}

/**
 * test the min attribute
 *
 * we use Number() instead of parseFloat(), because an invalid attribute
 * value like "123abc" should result in an error.
 */
function test_min (element) {
  var type = get_type(element);

  if (!element.value || !element.hasAttribute('min')) {
    /* we're not responsible here */
    return true;
  }

  var value = void 0,
      min = void 0;
  if (dates.indexOf(type) > -1) {
    value = string_to_date(element.value, type);
    value = value === null ? NaN : +value;
    min = string_to_date(element.getAttribute('min'), type);
    min = min === null ? NaN : +min;
  } else {
    value = Number(element.value);
    min = Number(element.getAttribute('min'));
  }

  /* we cannot validate invalid values and trust on badInput, if isNaN(value) */
  return isNaN(min) || isNaN(value) || value >= min;
}

/**
 * test the minlength attribute
 */
function test_minlength (element) {
  if (!element.value || text_types.indexOf(get_type(element)) === -1 || !element.hasAttribute('minlength') || !element.getAttribute('minlength') // catch minlength=""
  ) {
      return true;
    }

  var minlength = parseInt(element.getAttribute('minlength'), 10);

  /* check, if the minlength value is usable at all. */
  if (isNaN(minlength) || minlength < 0) {
    return true;
  }

  return unicode_string_length(element.value) >= minlength;
}

/**
 * test the pattern attribute
 */

function test_pattern (element) {
    return !element.value || !element.hasAttribute('pattern') || new RegExp('^(?:' + element.getAttribute('pattern') + ')$').test(element.value);
}

function has_submittable_option(select) {
  /* Definition of the placeholder label option:
   * https://www.w3.org/TR/html5/sec-forms.html#element-attrdef-select-required
   * Being required (the first constraint in the spec) is trivially true, since
   * this function is only called for such selects.
   */
  var has_placeholder_option = !select.multiple && select.size <= 1 && select.options.length > 0 && select.options[0].parentNode == select && select.options[0].value === '';
  return (
    /* anything selected at all? That's redundant with the .some() call below,
     * but more performant in the most probable error case. */
    select.selectedIndex > -1 && Array.prototype.some.call(select.options, function (option) {
      return (
        /* it isn't the placeholder option */
        (!has_placeholder_option || option.index !== 0) &&
        /* it isn't disabled */
        !option.disabled &&
        /* and it is, in fact, selected */
        option.selected
      );
    })
  );
}

/**
 * test the required attribute
 */
function test_required (element) {
  if (element.type === 'radio') {
    /* the happy (and quick) path for radios: */
    if (element.hasAttribute('required') && element.checked) {
      return true;
    }

    var radiogroup = get_radiogroup(element);

    /* if any radio in the group is required, we need any (not necessarily the
     * same) radio to be checked */
    if (radiogroup.some(function (radio) {
      return radio.hasAttribute('required');
    })) {
      return radiogroup.some(function (radio) {
        return radio.checked;
      });
    }
    /* not required, validation passes */
    return true;
  }

  if (!element.hasAttribute('required')) {
    /* nothing to do */
    return true;
  }

  if (element instanceof window.HTMLSelectElement) {
    return has_submittable_option(element);
  }

  return element.type === 'checkbox' ? element.checked : !!element.value;
}

/**
 * test the step attribute
 */
function test_step (element) {
  var type = get_type(element);

  if (!element.value || numbers.indexOf(type) === -1 || (element.getAttribute('step') || '').toLowerCase() === 'any') {
    /* we're not responsible here. Note: If no step attribute is given, we
     * need to validate against the default step as per spec. */
    return true;
  }

  var step = element.getAttribute('step');
  if (step) {
    step = string_to_number(step, type);
  } else {
    step = default_step[type] || 1;
  }

  if (step <= 0 || isNaN(step)) {
    /* error in specified "step". We cannot validate against it, so the value
     * is true. */
    return true;
  }

  var scale = step_scale_factor[type] || 1;

  var value = string_to_number(element.value, type);
  var min = string_to_number(element.getAttribute('min') || element.getAttribute('value') || '', type);

  if (isNaN(value)) {
    /* we cannot compare an invalid value and trust that the badInput validator
     * takes over from here */
    return true;
  }

  if (isNaN(min)) {
    min = default_step_base[type] || 0;
  }

  if (type === 'month') {
    /* type=month has month-wide steps. See
     * https://html.spec.whatwg.org/multipage/forms.html#month-state-%28type=month%29
     */
    min = new Date(min).getUTCFullYear() * 12 + new Date(min).getUTCMonth();
    value = new Date(value).getUTCFullYear() * 12 + new Date(value).getUTCMonth();
  }

  var result = Math.abs(min - value) % (step * scale);

  return result < 0.00000001 ||
  /* crappy floating-point arithmetics! */
  result > step * scale - 0.00000001;
}

var ws_on_start_or_end = /^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g;

/**
 * trim a string of whitespace
 *
 * We don't use String.trim() to remove the need to polyfill it.
 */
function trim (str) {
  return str.replace(ws_on_start_or_end, '');
}

/**
 * split a string on comma and trim the components
 *
 * As specified at
 * https://html.spec.whatwg.org/multipage/infrastructure.html#split-a-string-on-commas
 * plus removing empty entries.
 */
function comma_split (str) {
  return str.split(',').map(function (item) {
    return trim(item);
  }).filter(function (b) {
    return b;
  });
}

/* we use a dummy <a> where we set the href to test URL validity
 * The definition is out of the "global" scope so that JSDOM can be instantiated
 * after loading Hyperform for tests.
 */
var url_canary;

/* see https://html.spec.whatwg.org/multipage/forms.html#valid-e-mail-address */
var email_pattern = /^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/;

/**
 * test the type-inherent syntax
 */
function test_type (element) {
  var type = get_type(element);

  if (type !== 'file' && !element.value || type !== 'file' && type_checked.indexOf(type) === -1) {
    /* we're not responsible for this element */
    return true;
  }

  var is_valid = true;

  switch (type) {
    case 'url':
      if (!url_canary) {
        url_canary = document.createElement('a');
      }
      var value = trim(element.value);
      url_canary.href = value;
      is_valid = url_canary.href === value || url_canary.href === value + '/';
      break;
    case 'email':
      if (element.hasAttribute('multiple')) {
        is_valid = comma_split(element.value).every(function (value) {
          return email_pattern.test(value);
        });
      } else {
        is_valid = email_pattern.test(trim(element.value));
      }
      break;
    case 'file':
      if ('files' in element && element.files.length && element.hasAttribute('accept')) {
        var patterns = comma_split(element.getAttribute('accept')).map(function (pattern) {
          if (/^(audio|video|image)\/\*$/.test(pattern)) {
            pattern = new RegExp('^' + RegExp.$1 + '/.+$');
          }
          return pattern;
        });

        if (!patterns.length) {
          break;
        }

        fileloop: for (var i = 0; i < element.files.length; i++) {
          /* we need to match a whitelist, so pre-set with false */
          var file_valid = false;

          patternloop: for (var j = 0; j < patterns.length; j++) {
            var file = element.files[i];
            var pattern = patterns[j];

            var fileprop = file.type;

            if (typeof pattern === 'string' && pattern.substr(0, 1) === '.') {
              if (file.name.search('.') === -1) {
                /* no match with any file ending */
                continue patternloop;
              }

              fileprop = file.name.substr(file.name.lastIndexOf('.'));
            }

            if (fileprop.search(pattern) === 0) {
              /* we found one match and can quit looking */
              file_valid = true;
              break patternloop;
            }
          }

          if (!file_valid) {
            is_valid = false;
            break fileloop;
          }
        }
      }
  }

  return is_valid;
}

/**
 * boilerplate function for all tests but customError
 */
function check$1(test, react) {
  return function (element) {
    var invalid = !test(element);
    if (invalid) {
      react(element);
    }
    return invalid;
  };
}

/**
 * create a common function to set error messages
 */
function set_msg(element, msgtype, _default) {
  message_store.set(element, custom_messages.get(element, msgtype, _default));
}

var badInput = check$1(test_bad_input, function (element) {
  return set_msg(element, 'badInput', _('Please match the requested type.'));
});

function customError(element) {
  /* prevent infinite loops when the custom validators call setCustomValidity(),
   * which in turn calls this code again. We check, if there is an already set
   * custom validity message there. */
  if (element.__hf_custom_validation_running) {
    var msg = message_store.get(element);
    return msg && msg.is_custom;
  }

  /* check, if there are custom validators in the registry, and call
   * them. */
  var custom_validators = custom_validator_registry.get(element);
  var cvl = custom_validators.length;
  var valid = true;

  if (cvl) {
    element.__hf_custom_validation_running = true;
    for (var i = 0; i < cvl; i++) {
      var result = custom_validators[i](element);
      if (result !== undefined && !result) {
        valid = false;
        /* break on first invalid response */
        break;
      }
    }
    delete element.__hf_custom_validation_running;
  }

  /* check, if there are other validity messages already */
  if (valid) {
    var _msg = message_store.get(element);
    valid = !(_msg.toString() && 'is_custom' in _msg);
  }

  return !valid;
}

var patternMismatch = check$1(test_pattern, function (element) {
  set_msg(element, 'patternMismatch', element.title ? sprintf(_('PatternMismatchWithTitle'), element.title) : _('PatternMismatch'));
});

/**
 * TODO: when rangeOverflow and rangeUnderflow are both called directly and
 * successful, the inRange and outOfRange classes won't get removed, unless
 * element.validityState.valid is queried, too.
 */
var rangeOverflow = check$1(test_max, function (element) {
  var type = get_type(element);
  var wrapper = get_wrapper(element);
  var outOfRangeClass = wrapper && wrapper.settings.classes.outOfRange || 'hf-out-of-range';
  var inRangeClass = wrapper && wrapper.settings.classes.inRange || 'hf-in-range';

  var msg = void 0;

  switch (type) {
    case 'date':
    case 'datetime':
    case 'datetime-local':
      msg = sprintf(_('DateRangeOverflow'), format_date(string_to_date(element.getAttribute('max'), type), type));
      break;
    case 'time':
      msg = sprintf(_('TimeRangeOverflow'), format_date(string_to_date(element.getAttribute('max'), type), type));
      break;
    // case 'number':
    default:
      msg = sprintf(_('NumberRangeOverflow'), string_to_number(element.getAttribute('max'), type));
      break;
  }

  set_msg(element, 'rangeOverflow', msg);
  element.classList.add(outOfRangeClass);
  element.classList.remove(inRangeClass);
});

var rangeUnderflow = check$1(test_min, function (element) {
  var type = get_type(element);
  var wrapper = get_wrapper(element);
  var outOfRangeClass = wrapper && wrapper.settings.classes.outOfRange || 'hf-out-of-range';
  var inRangeClass = wrapper && wrapper.settings.classes.inRange || 'hf-in-range';

  var msg = void 0;

  switch (type) {
    case 'date':
    case 'datetime':
    case 'datetime-local':
      msg = sprintf(_('DateRangeUnderflow'), format_date(string_to_date(element.getAttribute('min'), type), type));
      break;
    case 'time':
      msg = sprintf(_('TimeRangeUnderflow'), format_date(string_to_date(element.getAttribute('min'), type), type));
      break;
    // case 'number':
    default:
      msg = sprintf(_('NumberRangeUnderflow'), string_to_number(element.getAttribute('min'), type));
      break;
  }

  set_msg(element, 'rangeUnderflow', msg);
  element.classList.add(outOfRangeClass);
  element.classList.remove(inRangeClass);
});

var stepMismatch = check$1(test_step, function (element) {
  var list = get_next_valid(element);
  var min = list[0];
  var max = list[1];
  var sole = false;
  var msg = void 0;

  if (min === null) {
    sole = max;
  } else if (max === null) {
    sole = min;
  }

  if (sole !== false) {
    msg = sprintf(_('StepMismatchOneValue'), sole);
  } else {
    msg = sprintf(_('StepMismatch'), min, max);
  }
  set_msg(element, 'stepMismatch', msg);
});

var tooLong = check$1(test_maxlength, function (element) {
  set_msg(element, 'tooLong', sprintf(_('TextTooLong'), element.getAttribute('maxlength'), unicode_string_length(element.value)));
});

var tooShort = check$1(test_minlength, function (element) {
  set_msg(element, 'tooShort', sprintf(_('Please lengthen this text to %l characters or more (you are currently using %l characters).'), element.getAttribute('minlength'), unicode_string_length(element.value)));
});

var typeMismatch = check$1(test_type, function (element) {
  var msg = _('Please use the appropriate format.');
  var type = get_type(element);

  if (type === 'email') {
    if (element.hasAttribute('multiple')) {
      msg = _('Please enter a comma separated list of email addresses.');
    } else {
      msg = _('InvalidEmail');
    }
  } else if (type === 'url') {
    msg = _('InvalidURL');
  } else if (type === 'file') {
    msg = _('Please select a file of the correct type.');
  }

  set_msg(element, 'typeMismatch', msg);
});

var valueMissing = check$1(test_required, function (element) {
  var msg = _('ValueMissing');
  var type = get_type(element);

  if (type === 'checkbox') {
    msg = _('CheckboxMissing');
  } else if (type === 'radio') {
    msg = _('RadioMissing');
  } else if (type === 'file') {
    if (element.hasAttribute('multiple')) {
      msg = _('Please select one or more files.');
    } else {
      msg = _('FileMissing');
    }
  } else if (element instanceof window.HTMLSelectElement) {
    msg = _('SelectMissing');
  }

  set_msg(element, 'valueMissing', msg);
});

/**
 * the "valid" property calls all other validity checkers and returns true,
 * if all those return false.
 *
 * This is the major access point for _all_ other API methods, namely
 * (check|report)Validity().
 */
var valid = function valid(element) {
  var wrapper = get_wrapper(element);
  var validClass = wrapper && wrapper.settings.classes.valid || 'hf-valid';
  var invalidClass = wrapper && wrapper.settings.classes.invalid || 'hf-invalid';
  var userInvalidClass = wrapper && wrapper.settings.classes.userInvalid || 'hf-user-invalid';
  var userValidClass = wrapper && wrapper.settings.classes.userValid || 'hf-user-valid';
  var inRangeClass = wrapper && wrapper.settings.classes.inRange || 'hf-in-range';
  var outOfRangeClass = wrapper && wrapper.settings.classes.outOfRange || 'hf-out-of-range';
  var validatedClass = wrapper && wrapper.settings.classes.validated || 'hf-validated';

  element.classList.add(validatedClass);

  var _arr = [badInput, customError, patternMismatch, rangeOverflow, rangeUnderflow, stepMismatch, tooLong, tooShort, typeMismatch, valueMissing];
  for (var _i = 0; _i < _arr.length; _i++) {
    var checker = _arr[_i];
    if (checker(element)) {
      element.classList.add(invalidClass);
      element.classList.remove(validClass);
      element.classList.remove(userValidClass);
      if ((element.type === 'checkbox' || element.type === 'radio') && element.checked !== element.defaultChecked ||
      /* the following test is trivially false for checkboxes/radios */
      element.value !== element.defaultValue) {
        element.classList.add(userInvalidClass);
      } else {
        element.classList.remove(userInvalidClass);
      }
      element.setAttribute('aria-invalid', 'true');
      return false;
    }
  }

  message_store.delete(element);
  element.classList.remove(invalidClass);
  element.classList.remove(userInvalidClass);
  element.classList.remove(outOfRangeClass);
  element.classList.add(validClass);
  element.classList.add(inRangeClass);
  if (element.value !== element.defaultValue) {
    element.classList.add(userValidClass);
  } else {
    element.classList.remove(userValidClass);
  }
  element.setAttribute('aria-invalid', 'false');
  return true;
};

var validity_state_checkers = {
  badInput: badInput,
  customError: customError,
  patternMismatch: patternMismatch,
  rangeOverflow: rangeOverflow,
  rangeUnderflow: rangeUnderflow,
  stepMismatch: stepMismatch,
  tooLong: tooLong,
  tooShort: tooShort,
  typeMismatch: typeMismatch,
  valueMissing: valueMissing,
  valid: valid
};

/**
 * the validity state constructor
 */
var ValidityState = function ValidityState(element) {
  if (!(element instanceof window.HTMLElement)) {
    throw new Error('cannot create a ValidityState for a non-element');
  }

  var cached = ValidityState.cache.get(element);
  if (cached) {
    return cached;
  }

  if (!(this instanceof ValidityState)) {
    /* working around a forgotten `new` */
    return new ValidityState(element);
  }

  this.element = element;
  ValidityState.cache.set(element, this);
};

/**
 * the prototype for new validityState instances
 */
var ValidityStatePrototype = {};
ValidityState.prototype = ValidityStatePrototype;

ValidityState.cache = new WeakMap();

/* small wrapper around the actual validator to check if the validator
 * should actually be called. `this` refers to the ValidityState object. */
var checker_getter = function checker_getter(func) {
  return function () {
    if (!is_validation_candidate(this.element)) {
      /* not being validated == valid by default */
      return true;
    }
    return func(this.element);
  };
};

/**
 * copy functionality from the validity checkers to the ValidityState
 * prototype
 */
for (var prop in validity_state_checkers) {
  Object.defineProperty(ValidityStatePrototype, prop, {
    configurable: true,
    enumerable: true,
    get: checker_getter(validity_state_checkers[prop]),
    set: undefined
  });
}

/**
 * mark the validity prototype, because that is what the client-facing
 * code deals with mostly, not the property descriptor thing */
mark(ValidityStatePrototype);

/**
 * check element's validity and report an error back to the user
 */
function reportValidity(element) {
  /* if this is a <form>, report validity of all child inputs */
  if (element instanceof window.HTMLFormElement) {
    element.__hf_form_validation = true;
    var form_valid = get_validated_elements(element).map(reportValidity).every(function (b) {
      return b;
    });
    delete element.__hf_form_validation;
    return form_valid;
  }

  /* we copy checkValidity() here, b/c we have to check if the "invalid"
   * event was canceled. */
  var valid = ValidityState(element).valid;
  var event;
  if (valid) {
    var wrapped_form = get_wrapper(element);
    if (wrapped_form && wrapped_form.settings.validEvent) {
      event = trigger_event(element, 'valid', { cancelable: true });
    }
  } else {
    event = trigger_event(element, 'invalid', { cancelable: true });
  }

  if (!event || !event.defaultPrevented) {
    Renderer.showWarning(element, !!element.form.__hf_form_validation);
  }

  return valid;
}

/**
 * submit a form, because `element` triggered it
 *
 * This method also dispatches a submit event on the form prior to the
 * submission. The event contains the trigger element as `submittedVia`.
 *
 * If the element is a button with a name, the name=value pair will be added
 * to the submitted data.
 */
function submit_form_via(element) {
  /* apparently, the submit event is not triggered in most browsers on
   * the submit() method, so we do it manually here to model a natural
   * submit as closely as possible.
   * Now to the fun fact: If you trigger a submit event from a form, what
   * do you think should happen?
   * 1) the form will be automagically submitted by the browser, or
   * 2) nothing.
   * And as you already suspected, the correct answer is: both! Firefox
   * opts for 1), Chrome for 2). Yay! */
  var event_got_cancelled;

  var submit_event = create_event('submit', { cancelable: true });
  /* force Firefox to not submit the form, then fake preventDefault() */
  submit_event.preventDefault();
  Object.defineProperty(submit_event, 'defaultPrevented', {
    value: false,
    writable: true
  });
  Object.defineProperty(submit_event, 'preventDefault', {
    value: function value() {
      return submit_event.defaultPrevented = event_got_cancelled = true;
    },
    writable: true
  });
  trigger_event(element.form, submit_event, {}, { submittedVia: element });

  if (!event_got_cancelled) {
    add_submit_field(element);
    window.HTMLFormElement.prototype.submit.call(element.form);
    window.setTimeout(function () {
      return remove_submit_field(element);
    });
  }
}

/**
 * if a submit button was clicked, add its name=value by means of a type=hidden
 * input field
 */
function add_submit_field(button) {
  if (['image', 'submit'].indexOf(button.type) > -1 && button.name) {
    var wrapper = get_wrapper(button.form) || {};
    var submit_helper = wrapper.submit_helper;
    if (submit_helper) {
      if (submit_helper.parentNode) {
        submit_helper.parentNode.removeChild(submit_helper);
      }
    } else {
      submit_helper = document.createElement('input');
      submit_helper.type = 'hidden';
      wrapper.submit_helper = submit_helper;
    }
    submit_helper.name = button.name;
    submit_helper.value = button.value;
    button.form.appendChild(submit_helper);
  }
}

/**
 * remove a possible helper input, that was added by `add_submit_field`
 */
function remove_submit_field(button) {
  if (['image', 'submit'].indexOf(button.type) > -1 && button.name) {
    var wrapper = get_wrapper(button.form) || {};
    var submit_helper = wrapper.submit_helper;
    if (submit_helper && submit_helper.parentNode) {
      submit_helper.parentNode.removeChild(submit_helper);
    }
  }
}

/**
 * check a form's validity and submit it
 *
 * The method triggers a cancellable `validate` event on the form. If the
 * event is cancelled, form submission will be aborted, too.
 *
 * If the form is found to contain invalid fields, focus the first field.
 */
function check(button) {
  /* trigger a "validate" event on the form to be submitted */
  var val_event = trigger_event(button.form, 'validate', { cancelable: true });
  if (val_event.defaultPrevented) {
    /* skip the whole submit thing, if the validation is canceled. A user
     * can still call form.submit() afterwards. */
    return;
  }

  var valid = true;
  var first_invalid;
  button.form.__hf_form_validation = true;
  get_validated_elements(button.form).map(function (element) {
    if (!reportValidity(element)) {
      valid = false;
      if (!first_invalid && 'focus' in element) {
        first_invalid = element;
      }
    }
  });
  delete button.form.__hf_form_validation;

  if (valid) {
    submit_form_via(button);
  } else if (first_invalid) {
    /* focus the first invalid element, if validation went south */
    first_invalid.focus();
    /* tell the tale, if anyone wants to react to it */
    trigger_event(button.form, 'forminvalid');
  }
}

/**
 * test if node is a submit button
 */
function is_submit_button(node) {
  return (
    /* must be an input or button element... */
    (node.nodeName === 'INPUT' || node.nodeName === 'BUTTON') && (

    /* ...and have a submitting type */
    node.type === 'image' || node.type === 'submit')
  );
}

/**
 * test, if the click event would trigger a submit
 */
function is_submitting_click(event, button) {
  return (
    /* prevented default: won't trigger a submit */
    !event.defaultPrevented && (

    /* left button or middle button (submits in Chrome) */
    !('button' in event) || event.button < 2) &&

    /* must be a submit button... */
    is_submit_button(button) &&

    /* the button needs a form, that's going to be submitted */
    button.form &&

    /* again, if the form should not be validated, we're out of the game */
    !button.form.hasAttribute('novalidate')
  );
}

/**
 * test, if the keypress event would trigger a submit
 */
function is_submitting_keypress(event) {
  return (
    /* prevented default: won't trigger a submit */
    !event.defaultPrevented && (
    /* ...and <Enter> was pressed... */
    event.keyCode === 13 &&

    /* ...on an <input> that is... */
    event.target.nodeName === 'INPUT' &&

    /* ...a standard text input field (not checkbox, ...) */
    text_types.indexOf(event.target.type) > -1 ||
    /* or <Enter> or <Space> was pressed... */
    (event.keyCode === 13 || event.keyCode === 32) &&

    /* ...on a submit button */
    is_submit_button(event.target)) &&

    /* there's a form... */
    event.target.form &&

    /* ...and the form allows validation */
    !event.target.form.hasAttribute('novalidate')
  );
}

/**
 * catch clicks to children of <button>s
 */
function get_clicked_button(element) {
  if (is_submit_button(element)) {
    return element;
  } else if (matches(element, 'button:not([type]) *, button[type="submit"] *')) {
    return get_clicked_button(element.parentNode);
  } else {
    return null;
  }
}

/**
 * return event handler to catch explicit submission by click on a button
 */
function get_click_handler() {
  var ignore = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : false;

  return function (event) {
    var button = get_clicked_button(event.target);
    if (button && is_submitting_click(event, button)) {
      event.preventDefault();
      if (ignore || button.hasAttribute('formnovalidate')) {
        /* if validation should be ignored, we're not interested in any checks */
        submit_form_via(button);
      } else {
        check(button);
      }
    }
  };
}
var click_handler = get_click_handler();
var ignored_click_handler = get_click_handler(true);

/**
 * catch implicit submission by pressing <Enter> in some situations
 */
function get_keypress_handler(ignore) {
  return function keypress_handler(event) {
    if (is_submitting_keypress(event)) {
      event.preventDefault();

      var wrapper = get_wrapper(event.target.form) || { settings: {} };
      if (wrapper.settings.preventImplicitSubmit) {
        /* user doesn't want an implicit submit. Cancel here. */
        return;
      }

      /* check, that there is no submit button in the form. Otherwise
      * that should be clicked. */
      var el = event.target.form.elements.length;
      var submit;
      for (var i = 0; i < el; i++) {
        if (['image', 'submit'].indexOf(event.target.form.elements[i].type) > -1) {
          submit = event.target.form.elements[i];
          break;
        }
      }

      if (submit) {
        submit.click();
      } else if (ignore) {
        submit_form_via(event.target);
      } else {
        check(event.target);
      }
    }
  };
}
var keypress_handler = get_keypress_handler();
var ignored_keypress_handler = get_keypress_handler(true);

/**
 * catch all relevant events _prior_ to a form being submitted
 *
 * @param bool ignore bypass validation, when an attempt to submit the
 *                    form is detected. True, when the wrapper's revalidate
 *                    setting is 'never'.
 */
function catch_submit(listening_node) {
  var ignore = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : false;

  if (ignore) {
    listening_node.addEventListener('click', ignored_click_handler);
    listening_node.addEventListener('keypress', ignored_keypress_handler);
  } else {
    listening_node.addEventListener('click', click_handler);
    listening_node.addEventListener('keypress', keypress_handler);
  }
}

/**
 * decommission the event listeners from catch_submit() again
 */
function uncatch_submit(listening_node) {
  listening_node.removeEventListener('click', ignored_click_handler);
  listening_node.removeEventListener('keypress', ignored_keypress_handler);
  listening_node.removeEventListener('click', click_handler);
  listening_node.removeEventListener('keypress', keypress_handler);
}

/**
 * remove `property` from element and restore _original_property, if present
 */
function uninstall_property (element, property) {
  try {
    delete element[property];
  } catch (e) {
    /* Safari <= 9 and PhantomJS will end up here :-( Nothing to do except
     * warning */
    var wrapper = get_wrapper(element);
    if (wrapper && wrapper.settings.debug) {
      /* global console */
      console.log('[hyperform] cannot uninstall custom property ' + property);
    }
    return false;
  }

  var original_descriptor = Object.getOwnPropertyDescriptor(element, '_original_' + property);

  if (original_descriptor) {
    Object.defineProperty(element, property, original_descriptor);
  }
}

/**
 * add `property` to an element
 *
 * ATTENTION! This function will search for an equally named property on the
 * *prototype* of an element, if element is a concrete DOM node. Do not use
 * it as general-purpose property installer.
 *
 * js> installer(element, 'foo', { value: 'bar' });
 * js> assert(element.foo === 'bar');
 */
function install_property (element, property, descriptor) {
  descriptor.configurable = true;
  descriptor.enumerable = true;
  if ('value' in descriptor) {
    descriptor.writable = true;
  }

  /* on concrete instances, i.e., <input> elements, the naive lookup
   * yields undefined. We have to look on its prototype then. On elements
   * like the actual HTMLInputElement object the first line works. */
  var original_descriptor = Object.getOwnPropertyDescriptor(element, property);
  if (original_descriptor === undefined) {
    original_descriptor = Object.getOwnPropertyDescriptor(Object.getPrototypeOf(element), property);
  }

  if (original_descriptor) {

    if (original_descriptor.configurable === false) {
      /* Safari <= 9 and PhantomJS will end up here :-( Nothing to do except
       * warning */
      var wrapper = get_wrapper(element);
      if (wrapper && wrapper.settings.debug) {
        /* global console */
        console.log('[hyperform] cannot install custom property ' + property);
      }
      return false;
    }

    /* we already installed that property... */
    if (original_descriptor.get && original_descriptor.get.__hyperform || original_descriptor.value && original_descriptor.value.__hyperform) {
      return;
    }

    /* publish existing property under new name, if it's not from us */
    Object.defineProperty(element, '_original_' + property, original_descriptor);
  }

  delete element[property];
  Object.defineProperty(element, property, descriptor);

  return true;
}

function is_field (element) {
        return element instanceof window.HTMLButtonElement || element instanceof window.HTMLInputElement || element instanceof window.HTMLSelectElement || element instanceof window.HTMLTextAreaElement || element instanceof window.HTMLFieldSetElement || element === window.HTMLButtonElement.prototype || element === window.HTMLInputElement.prototype || element === window.HTMLSelectElement.prototype || element === window.HTMLTextAreaElement.prototype || element === window.HTMLFieldSetElement.prototype;
}

/**
 * set a custom validity message or delete it with an empty string
 */
function setCustomValidity(element, msg) {
  if (!msg) {
    message_store.delete(element, true);
  } else {
    message_store.set(element, msg, true);
  }
  /* live-update the warning */
  var warning = Renderer.getWarning(element);
  if (warning) {
    Renderer.setMessage(warning, msg, element);
  }
  /* update any classes if the validity state changes */
  validity_state_checkers.valid(element);
}

/**
 * implement the valueAsDate functionality
 *
 * @see https://html.spec.whatwg.org/multipage/forms.html#dom-input-valueasdate
 */
function valueAsDate(element) {
  var value = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : undefined;

  var type = get_type(element);
  if (dates.indexOf(type) > -1) {
    if (value !== undefined) {
      /* setter: value must be null or a Date() */
      if (value === null) {
        element.value = '';
      } else if (value instanceof Date) {
        if (isNaN(value.getTime())) {
          element.value = '';
        } else {
          element.value = date_to_string(value, type);
        }
      } else {
        throw new window.DOMException('valueAsDate setter encountered invalid value', 'TypeError');
      }
      return;
    }

    var value_date = string_to_date(element.value, type);
    return value_date instanceof Date ? value_date : null;
  } else if (value !== undefined) {
    /* trying to set a date on a not-date input fails */
    throw new window.DOMException('valueAsDate setter cannot set date on this element', 'InvalidStateError');
  }

  return null;
}

/**
 * implement the valueAsNumber functionality
 *
 * @see https://html.spec.whatwg.org/multipage/forms.html#dom-input-valueasnumber
 */
function valueAsNumber(element) {
  var value = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : undefined;

  var type = get_type(element);
  if (numbers.indexOf(type) > -1) {
    if (type === 'range' && element.hasAttribute('multiple')) {
      /* @see https://html.spec.whatwg.org/multipage/forms.html#do-not-apply */
      return NaN;
    }

    if (value !== undefined) {
      /* setter: value must be NaN or a finite number */
      if (isNaN(value)) {
        element.value = '';
      } else if (typeof value === 'number' && window.isFinite(value)) {
        try {
          /* try setting as a date, but... */
          valueAsDate(element, new Date(value));
        } catch (e) {
          /* ... when valueAsDate is not responsible, ... */
          if (!(e instanceof window.DOMException)) {
            throw e;
          }
          /* ... set it via Number.toString(). */
          element.value = value.toString();
        }
      } else {
        throw new window.DOMException('valueAsNumber setter encountered invalid value', 'TypeError');
      }
      return;
    }

    return string_to_number(element.value, type);
  } else if (value !== undefined) {
    /* trying to set a number on a not-number input fails */
    throw new window.DOMException('valueAsNumber setter cannot set number on this element', 'InvalidStateError');
  }

  return NaN;
}

/**
 *
 */
function stepDown(element) {
  var n = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 1;

  if (numbers.indexOf(get_type(element)) === -1) {
    throw new window.DOMException('stepDown encountered invalid type', 'InvalidStateError');
  }
  if ((element.getAttribute('step') || '').toLowerCase() === 'any') {
    throw new window.DOMException('stepDown encountered step "any"', 'InvalidStateError');
  }

  var prev = get_next_valid(element, n)[0];

  if (prev !== null) {
    valueAsNumber(element, prev);
  }
}

/**
 *
 */
function stepUp(element) {
  var n = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 1;

  if (numbers.indexOf(get_type(element)) === -1) {
    throw new window.DOMException('stepUp encountered invalid type', 'InvalidStateError');
  }
  if ((element.getAttribute('step') || '').toLowerCase() === 'any') {
    throw new window.DOMException('stepUp encountered step "any"', 'InvalidStateError');
  }

  var next = get_next_valid(element, n)[1];

  if (next !== null) {
    valueAsNumber(element, next);
  }
}

/**
 * get the validation message for an element, empty string, if the element
 * satisfies all constraints.
 */
function validationMessage(element) {
  var msg = message_store.get(element);
  if (!msg) {
    return '';
  }

  /* make it a primitive again, since message_store returns String(). */
  return msg.toString();
}

/**
 * check, if an element will be subject to HTML5 validation at all
 */
function willValidate(element) {
  return is_validation_candidate(element);
}

var gA = function gA(prop) {
  return function () {
    return do_filter('attr_get_' + prop, this.getAttribute(prop), this);
  };
};

var sA = function sA(prop) {
  return function (value) {
    this.setAttribute(prop, do_filter('attr_set_' + prop, value, this));
  };
};

var gAb = function gAb(prop) {
  return function () {
    return do_filter('attr_get_' + prop, this.hasAttribute(prop), this);
  };
};

var sAb = function sAb(prop) {
  return function (value) {
    if (do_filter('attr_set_' + prop, value, this)) {
      this.setAttribute(prop, prop);
    } else {
      this.removeAttribute(prop);
    }
  };
};

var gAn = function gAn(prop) {
  return function () {
    return do_filter('attr_get_' + prop, Math.max(0, Number(this.getAttribute(prop))), this);
  };
};

var sAn = function sAn(prop) {
  return function (value) {
    value = do_filter('attr_set_' + prop, value, this);
    if (/^[0-9]+$/.test(value)) {
      this.setAttribute(prop, value);
    }
  };
};

function install_properties(element) {
  var _arr = ['accept', 'max', 'min', 'pattern', 'placeholder', 'step'];

  for (var _i = 0; _i < _arr.length; _i++) {
    var prop = _arr[_i];
    install_property(element, prop, {
      get: gA(prop),
      set: sA(prop)
    });
  }

  var _arr2 = ['multiple', 'required', 'readOnly'];
  for (var _i2 = 0; _i2 < _arr2.length; _i2++) {
    var _prop = _arr2[_i2];
    install_property(element, _prop, {
      get: gAb(_prop.toLowerCase()),
      set: sAb(_prop.toLowerCase())
    });
  }

  var _arr3 = ['minLength', 'maxLength'];
  for (var _i3 = 0; _i3 < _arr3.length; _i3++) {
    var _prop2 = _arr3[_i3];
    install_property(element, _prop2, {
      get: gAn(_prop2.toLowerCase()),
      set: sAn(_prop2.toLowerCase())
    });
  }
}

function uninstall_properties(element) {
  var _arr4 = ['accept', 'max', 'min', 'pattern', 'placeholder', 'step', 'multiple', 'required', 'readOnly', 'minLength', 'maxLength'];

  for (var _i4 = 0; _i4 < _arr4.length; _i4++) {
    var prop = _arr4[_i4];
    uninstall_property(element, prop);
  }
}

var polyfills = {
  checkValidity: {
    value: mark(function () {
      return checkValidity(this);
    })
  },
  reportValidity: {
    value: mark(function () {
      return reportValidity(this);
    })
  },
  setCustomValidity: {
    value: mark(function (msg) {
      return setCustomValidity(this, msg);
    })
  },
  stepDown: {
    value: mark(function () {
      var n = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : 1;
      return stepDown(this, n);
    })
  },
  stepUp: {
    value: mark(function () {
      var n = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : 1;
      return stepUp(this, n);
    })
  },
  validationMessage: {
    get: mark(function () {
      return validationMessage(this);
    })
  },
  validity: {
    get: mark(function () {
      return ValidityState(this);
    })
  },
  valueAsDate: {
    get: mark(function () {
      return valueAsDate(this);
    }),
    set: mark(function (value) {
      valueAsDate(this, value);
    })
  },
  valueAsNumber: {
    get: mark(function () {
      return valueAsNumber(this);
    }),
    set: mark(function (value) {
      valueAsNumber(this, value);
    })
  },
  willValidate: {
    get: mark(function () {
      return willValidate(this);
    })
  }
};

function polyfill (element) {
  if (is_field(element)) {

    for (var prop in polyfills) {
      install_property(element, prop, polyfills[prop]);
    }

    install_properties(element);
  } else if (element instanceof window.HTMLFormElement || element === window.HTMLFormElement.prototype) {
    install_property(element, 'checkValidity', polyfills.checkValidity);
    install_property(element, 'reportValidity', polyfills.reportValidity);
  }
}

function polyunfill (element) {
  if (is_field(element)) {

    uninstall_property(element, 'checkValidity');
    uninstall_property(element, 'reportValidity');
    uninstall_property(element, 'setCustomValidity');
    uninstall_property(element, 'stepDown');
    uninstall_property(element, 'stepUp');
    uninstall_property(element, 'validationMessage');
    uninstall_property(element, 'validity');
    uninstall_property(element, 'valueAsDate');
    uninstall_property(element, 'valueAsNumber');
    uninstall_property(element, 'willValidate');

    uninstall_properties(element);
  } else if (element instanceof window.HTMLFormElement) {
    uninstall_property(element, 'checkValidity');
    uninstall_property(element, 'reportValidity');
  }
}

var instances = new WeakMap();

/**
 * wrap <form>s, window or document, that get treated with the global
 * hyperform()
 */
function Wrapper(form, settings) {

  /* do not allow more than one instance per form. Otherwise we'd end
   * up with double event handlers, polyfills re-applied, ... */
  var existing = instances.get(form);
  if (existing) {
    existing.settings = settings;
    return existing;
  }

  this.form = form;
  this.settings = settings;
  this.revalidator = this.revalidate.bind(this);

  instances.set(form, this);

  catch_submit(form, settings.revalidate === 'never');

  if (form === window || form.nodeType === 9) {
    /* install on the prototypes, when called for the whole document */
    this.install([window.HTMLButtonElement.prototype, window.HTMLInputElement.prototype, window.HTMLSelectElement.prototype, window.HTMLTextAreaElement.prototype, window.HTMLFieldSetElement.prototype]);
    polyfill(window.HTMLFormElement);
  } else if (form instanceof window.HTMLFormElement || form instanceof window.HTMLFieldSetElement) {
    this.install(form.elements);
    if (form instanceof window.HTMLFormElement) {
      polyfill(form);
    }
  }

  if (settings.revalidate === 'oninput' || settings.revalidate === 'hybrid') {
    /* in a perfect world we'd just bind to "input", but support here is
     * abysmal: http://caniuse.com/#feat=input-event */
    form.addEventListener('keyup', this.revalidator);
    form.addEventListener('change', this.revalidator);
  }
  if (settings.revalidate === 'onblur' || settings.revalidate === 'hybrid') {
    /* useCapture=true, because `blur` doesn't bubble. See
     * https://developer.mozilla.org/en-US/docs/Web/Events/blur#Event_delegation
     * for a discussion */
    form.addEventListener('blur', this.revalidator, true);
  }
}

Wrapper.prototype = {
  destroy: function destroy() {
    uncatch_submit(this.form);
    instances.delete(this.form);
    this.form.removeEventListener('keyup', this.revalidator);
    this.form.removeEventListener('change', this.revalidator);
    this.form.removeEventListener('blur', this.revalidator, true);
    if (this.form === window || this.form.nodeType === 9) {
      this.uninstall([window.HTMLButtonElement.prototype, window.HTMLInputElement.prototype, window.HTMLSelectElement.prototype, window.HTMLTextAreaElement.prototype, window.HTMLFieldSetElement.prototype]);
      polyunfill(window.HTMLFormElement);
    } else if (this.form instanceof window.HTMLFormElement || this.form instanceof window.HTMLFieldSetElement) {
      this.uninstall(this.form.elements);
      if (this.form instanceof window.HTMLFormElement) {
        polyunfill(this.form);
      }
    }
  },


  /**
   * revalidate an input element
   */
  revalidate: function revalidate(event) {
    if (event.target instanceof window.HTMLButtonElement || event.target instanceof window.HTMLTextAreaElement || event.target instanceof window.HTMLSelectElement || event.target instanceof window.HTMLInputElement) {

      if (this.settings.revalidate === 'hybrid') {
        /* "hybrid" somewhat simulates what browsers do. See for example
         * Firefox's :-moz-ui-invalid pseudo-class:
         * https://developer.mozilla.org/en-US/docs/Web/CSS/:-moz-ui-invalid */
        if (event.type === 'blur' && event.target.value !== event.target.defaultValue || ValidityState(event.target).valid) {
          /* on blur, update the report when the value has changed from the
           * default or when the element is valid (possibly removing a still
           * standing invalidity report). */
          reportValidity(event.target);
        } else if (event.type === 'keyup' && event.keyCode !== 9 || event.type === 'change') {
          if (ValidityState(event.target).valid) {
            // report instantly, when an element becomes valid,
            // postpone report to blur event, when an element is invalid
            reportValidity(event.target);
          }
        }
      } else if (event.type !== 'keyup' || event.keyCode !== 9) {
        /* do _not_ validate, when the user "tabbed" into the field initially,
         * i.e., a keyup event with keyCode 9 */
        reportValidity(event.target);
      }
    }
  },


  /**
   * install the polyfills on each given element
   *
   * If you add elements dynamically, you have to call install() on them
   * yourself:
   *
   * js> var form = hyperform(document.forms[0]);
   * js> document.forms[0].appendChild(input);
   * js> form.install(input);
   *
   * You can skip this, if you called hyperform on window or document.
   */
  install: function install(els) {
    if (els instanceof window.Element) {
      els = [els];
    }

    var els_length = els.length;

    for (var i = 0; i < els_length; i++) {
      polyfill(els[i]);
    }
  },
  uninstall: function uninstall(els) {
    if (els instanceof window.Element) {
      els = [els];
    }

    var els_length = els.length;

    for (var i = 0; i < els_length; i++) {
      polyunfill(els[i]);
    }
  }
};

/**
 * try to get the appropriate wrapper for a specific element by looking up
 * its parent chain
 *
 * @return Wrapper | undefined
 */
function get_wrapper(element) {
  var wrapped;

  if (element.form) {
    /* try a shortcut with the element's <form> */
    wrapped = instances.get(element.form);
  }

  /* walk up the parent nodes until document (including) */
  while (!wrapped && element) {
    wrapped = instances.get(element);
    element = element.parentNode;
  }

  if (!wrapped) {
    /* try the global instance, if exists. This may also be undefined. */
    wrapped = instances.get(window);
  }

  return wrapped;
}

/**
 * filter a form's elements for the ones needing validation prior to
 * a submit
 *
 * Returns an array of form elements.
 */
function get_validated_elements(form) {
  var wrapped_form = get_wrapper(form);

  return Array.prototype.filter.call(form.elements, function (element) {
    /* it must have a name (or validating nameless inputs is allowed) */
    if (element.getAttribute('name') || wrapped_form && wrapped_form.settings.validateNameless) {
      return true;
    }
    return false;
  });
}

/**
 * return either the data of a hook call or the result of action, if the
 * former is undefined
 *
 * @return function a function wrapper around action
 */
function return_hook_or (hook, action) {
  return function () {
    var data = call_hook(hook, Array.prototype.slice.call(arguments));

    if (data !== undefined) {
      return data;
    }

    return action.apply(this, arguments);
  };
}

/**
 * check an element's validity with respect to it's form
 */
var checkValidity = return_hook_or('checkValidity', function (element) {
  /* if this is a <form>, check validity of all child inputs */
  if (element instanceof window.HTMLFormElement) {
    return get_validated_elements(element).map(checkValidity).every(function (b) {
      return b;
    });
  }

  /* default is true, also for elements that are no validation candidates */
  var valid = ValidityState(element).valid;
  if (valid) {
    var wrapped_form = get_wrapper(element);
    if (wrapped_form && wrapped_form.settings.validEvent) {
      trigger_event(element, 'valid');
    }
  } else {
    trigger_event(element, 'invalid', { cancelable: true });
  }

  return valid;
});

var version = '0.9.23';

/* deprecate the old snake_case names
 * TODO: delme before next non-patch release
 */
function w(name) {
  var deprecated_message = 'Please use camelCase method names! The name "%s" is deprecated and will be removed in the next non-patch release.';
  /* global console */
  console.log(sprintf(deprecated_message, name));
}

/**
 * public hyperform interface:
 */
function hyperform(form) {
  var _ref = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : {};

  var classes = _ref.classes;
  var _ref$debug = _ref.debug;
  var debug = _ref$debug === undefined ? false : _ref$debug;
  var extend_fieldset = _ref.extend_fieldset;
  var extendFieldset = _ref.extendFieldset;
  var novalidate_on_elements = _ref.novalidate_on_elements;
  var novalidateOnElements = _ref.novalidateOnElements;
  var prevent_implicit_submit = _ref.prevent_implicit_submit;
  var preventImplicitSubmit = _ref.preventImplicitSubmit;
  var revalidate = _ref.revalidate;
  var _ref$strict = _ref.strict;
  var strict = _ref$strict === undefined ? false : _ref$strict;
  var valid_event = _ref.valid_event;
  var validEvent = _ref.validEvent;
  var _ref$validateNameless = _ref.validateNameless;
  var validateNameless = _ref$validateNameless === undefined ? false : _ref$validateNameless;


  if (!classes) {
    classes = {};
  }
  // TODO: clean up before next non-patch release
  if (extendFieldset === undefined) {
    if (extend_fieldset === undefined) {
      extendFieldset = !strict;
    } else {
      w('extend_fieldset');
      extendFieldset = extend_fieldset;
    }
  }
  if (novalidateOnElements === undefined) {
    if (novalidate_on_elements === undefined) {
      novalidateOnElements = !strict;
    } else {
      w('novalidate_on_elements');
      novalidateOnElements = novalidate_on_elements;
    }
  }
  if (preventImplicitSubmit === undefined) {
    if (prevent_implicit_submit === undefined) {
      preventImplicitSubmit = false;
    } else {
      w('prevent_implicit_submit');
      preventImplicitSubmit = prevent_implicit_submit;
    }
  }
  if (revalidate === undefined) {
    /* other recognized values: 'oninput', 'onblur', 'onsubmit' and 'never' */
    revalidate = strict ? 'onsubmit' : 'hybrid';
  }
  if (validEvent === undefined) {
    if (valid_event === undefined) {
      validEvent = !strict;
    } else {
      w('valid_event');
      validEvent = valid_event;
    }
  }

  var settings = { debug: debug, strict: strict, preventImplicitSubmit: preventImplicitSubmit, revalidate: revalidate,
    validEvent: validEvent, extendFieldset: extendFieldset, classes: classes, novalidateOnElements: novalidateOnElements,
    validateNameless: validateNameless
  };

  if (form instanceof window.NodeList || form instanceof window.HTMLCollection || form instanceof Array) {
    return Array.prototype.map.call(form, function (element) {
      return hyperform(element, settings);
    });
  }

  return new Wrapper(form, settings);
}

hyperform.version = version;

hyperform.checkValidity = checkValidity;
hyperform.reportValidity = reportValidity;
hyperform.setCustomValidity = setCustomValidity;
hyperform.stepDown = stepDown;
hyperform.stepUp = stepUp;
hyperform.validationMessage = validationMessage;
hyperform.ValidityState = ValidityState;
hyperform.valueAsDate = valueAsDate;
hyperform.valueAsNumber = valueAsNumber;
hyperform.willValidate = willValidate;

hyperform.setLanguage = function (lang) {
  set_language(lang);return hyperform;
};
hyperform.addTranslation = function (lang, catalog) {
  add_translation(lang, catalog);return hyperform;
};
hyperform.setRenderer = function (renderer, action) {
  Renderer.set(renderer, action);return hyperform;
};
hyperform.addValidator = function (element, validator) {
  custom_validator_registry.set(element, validator);return hyperform;
};
hyperform.setMessage = function (element, validator, message) {
  custom_messages.set(element, validator, message);return hyperform;
};
hyperform.addHook = function (hook, action, position) {
  add_hook(hook, action, position);return hyperform;
};
hyperform.removeHook = function (hook, action) {
  remove_hook(hook, action);return hyperform;
};

// TODO: Remove in next non-patch version
hyperform.set_language = function (lang) {
  w('set_language');set_language(lang);return hyperform;
};
hyperform.add_translation = function (lang, catalog) {
  w('add_translation');add_translation(lang, catalog);return hyperform;
};
hyperform.set_renderer = function (renderer, action) {
  w('set_renderer');Renderer.set(renderer, action);return hyperform;
};
hyperform.add_validator = function (element, validator) {
  w('add_validator');custom_validator_registry.set(element, validator);return hyperform;
};
hyperform.set_message = function (element, validator, message) {
  w('set_message');custom_messages.set(element, validator, message);return hyperform;
};
hyperform.add_hook = function (hook, action, position) {
  w('add_hook');add_hook(hook, action, position);return hyperform;
};
hyperform.remove_hook = function (hook, action) {
  w('remove_hook');remove_hook(hook, action);return hyperform;
};

if (document.currentScript && document.currentScript.hasAttribute('data-hf-autoload')) {
  hyperform(window);
}

module.exports = hyperform;
/*
    JavaScript autoComplete v1.0.5
    Copyright (c) 2014 Simon Steinberger / Pixabay
    GitHub: https://github.com/Pixabay/JavaScript-autoComplete
    License: http://www.opensource.org/licenses/mit-license.php
*/

var autoComplete = (function(){
    // "use strict";
    function autoComplete(options){
        if (!document.querySelector) return;

        // helpers
        function hasClass(el, className){ return el.classList ? el.classList.contains(className) : new RegExp('\\b'+ className+'\\b').test(el.className); }

        function addEvent(el, type, handler){
            if (el.attachEvent) el.attachEvent('on'+type, handler); else el.addEventListener(type, handler);
        }
        function removeEvent(el, type, handler){
            // if (el.removeEventListener) not working in IE11
            if (el.detachEvent) el.detachEvent('on'+type, handler); else el.removeEventListener(type, handler);
        }
        function live(elClass, event, cb, context){
            addEvent(context || document, event, function(e){
                var found, el = e.target || e.srcElement;
                while (el && !(found = hasClass(el, elClass))) el = el.parentElement;
                if (found) cb.call(el, e);
            });
        }

        var o = {
            selector: 0,
            source: 0,
            minChars: 3,
            delay: 150,
            offsetLeft: 0,
            offsetTop: 1,
            cache: 1,
            menuClass: '',
            renderItem: function (item, search){
                // escape special characters
                search = search.replace(/[-\/\\^$*+?.()|[\]{}]/g, '\\$&');
                var re = new RegExp("(" + search.split(' ').join('|') + ")", "gi");
                return '<div class="autocomplete-suggestion" data-val="' + item + '">' + item.replace(re, "<b>$1</b>") + '</div>';
            },
            onSelect: function(e, term, item){}
        };
        for (var k in options) { if (options.hasOwnProperty(k)) o[k] = options[k]; }

        // init
        var elems = typeof o.selector == 'object' ? [o.selector] : document.querySelectorAll(o.selector);
        for (var i=0; i<elems.length; i++) {
            var that = elems[i];

            // create suggestions container "sc"
            that.sc = document.createElement('div');
            that.sc.className = 'autocomplete-suggestions '+o.menuClass;

            that.autocompleteAttr = that.getAttribute('autocomplete');
            that.setAttribute('autocomplete', 'off');
            that.cache = {};
            that.last_val = '';

            that.updateSC = function(resize, next){
                var rect = that.getBoundingClientRect();
                that.sc.style.left = Math.round(rect.left + (window.pageXOffset || document.documentElement.scrollLeft) + o.offsetLeft) + 'px';
                that.sc.style.top = Math.round(rect.bottom + (window.pageYOffset || document.documentElement.scrollTop) + o.offsetTop) + 'px';
                that.sc.style.width = Math.round(rect.right - rect.left) + 'px'; // outerWidth
                if (!resize) {
                    that.sc.style.display = 'block';
                    that.sc.classList.remove('hide')
                    if (!that.sc.maxHeight) { that.sc.maxHeight = parseInt((window.getComputedStyle ? getComputedStyle(that.sc, null) : that.sc.currentStyle).maxHeight); }
                    if (!that.sc.suggestionHeight) that.sc.suggestionHeight = that.sc.querySelector('.autocomplete-suggestion').offsetHeight;
                    if (that.sc.suggestionHeight)
                        if (!next) that.sc.scrollTop = 0;
                        else {
                            var scrTop = that.sc.scrollTop, selTop = next.getBoundingClientRect().top - that.sc.getBoundingClientRect().top;
                            if (selTop + that.sc.suggestionHeight - that.sc.maxHeight > 0)
                                that.sc.scrollTop = selTop + that.sc.suggestionHeight + scrTop - that.sc.maxHeight;
                            else if (selTop < 0)
                                that.sc.scrollTop = selTop + scrTop;
                        }
                }
            }
            addEvent(window, 'resize', that.updateSC);
            document.body.appendChild(that.sc);

            live('autocomplete-suggestion', 'mouseleave', function(e){
                var sel = that.sc.querySelector('.autocomplete-suggestion.selected');
                if (sel) setTimeout(function(){ sel.className = sel.className.replace('selected', ''); }, 20);
            }, that.sc);

            live('autocomplete-suggestion', 'mouseover', function(e){
                var sel = that.sc.querySelector('.autocomplete-suggestion.selected');
                if (sel) sel.className = sel.className.replace('selected', '');
                this.className += ' selected';
            }, that.sc);

            live('autocomplete-suggestion', 'mousedown', function(e){
                if (hasClass(this, 'autocomplete-suggestion')) { // else outside click
                    var v = this.getAttribute('data-val');
                    that.value = v;
                    o.onSelect(e, v, this);
                    that.sc.style.display = 'none';
                    that.sc.classList.add("hide");

                }
            }, that.sc);

            that.blurHandler = function(){
                try { var over_sb = document.querySelector('.autocomplete-suggestions:hover'); } catch(e){ var over_sb = 0; }
                if (!over_sb) {
                    that.last_val = that.value;
                    that.sc.style.display = 'none';
                    that.sc.classList.add("hide");
                    setTimeout(function(){
                      that.sc.style.display = 'none';
                      that.sc.classList.add("hide");
                    }, 350); // hide suggestions on fast input
                } else if (that !== document.activeElement) setTimeout(function(){ that.focus(); }, 20);
            };
            addEvent(that, 'blur', that.blurHandler);

            var suggest = function(data, val){
                if (!val) {
                    var val = that.value;
                }
                that.cache[val] = data;
                if (data.length && val.length >= o.minChars) {
                    var s = '';
                    for (var i=0;i<data.length;i++) s += o.renderItem(data[i], val);
                    that.sc.innerHTML = s;
                    that.updateSC(0);
                }
                else {
                    that.sc.style.display = 'none';
                    that.sc.classList.add("hide");
                }
            }

            that.keydownHandler = function(e){
                var key = window.event ? e.keyCode : e.which;
                // down (40), up (38)
                if ((key == 40 || key == 38) && that.sc.innerHTML) {
                    var next, sel = that.sc.querySelector('.autocomplete-suggestion.selected');
                    if (!sel) {
                        next = (key == 40) ? that.sc.querySelector('.autocomplete-suggestion') : that.sc.childNodes[that.sc.childNodes.length - 1]; // first : last
                        next.className += ' selected';
                        that.value = next.getAttribute('data-val');
                    } else {
                        next = (key == 40) ? sel.nextSibling : sel.previousSibling;
                        if (next) {
                            sel.className = sel.className.replace('selected', '');
                            next.className += ' selected';
                            that.value = next.getAttribute('data-val');
                        }
                        else { sel.className = sel.className.replace('selected', ''); that.value = that.last_val; next = 0; }
                    }
                    that.updateSC(0, next);
                    return false;
                }
                // esc
                else if (key == 27) {
                  that.value = that.last_val;
                  that.sc.style.display = 'none';
                  that.sc.classList.add("hide");
                }
                // enter
                else if (key == 13 || key == 9) {
                    if (that.sc.style.display !== 'none') {
                        e.preventDefault();
                    }
                    var sel = that.sc.querySelector('.autocomplete-suggestion.selected');
                    if (sel && that.sc.style.display != 'none') {
                      o.onSelect(e, sel.getAttribute('data-val'), sel);
                      setTimeout(function(){
                        that.sc.style.display = 'none';
                        that.sc.classList.add("hide");
                    }, 20); }
                }
            };
            addEvent(that, 'keydown', that.keydownHandler);

            that.keyupHandler = function(e){
                var key = window.event ? e.keyCode : e.which;
                if (!key || (key < 35 || key > 40) && key != 13 && key != 27) {
                    var val = that.value;
                    if (val.length >= o.minChars) {
                        if (val != that.last_val) {
                            that.last_val = val;
                            clearTimeout(that.timer);
                            if (o.cache) {
                                if (val in that.cache) { suggest(that.cache[val]); return; }
                                // no requests if previous suggestions were empty
                                for (var i=1; i<val.length-o.minChars; i++) {
                                    var part = val.slice(0, val.length-i);
                                    if (part in that.cache && !that.cache[part].length) { suggest([]); return; }
                                }
                            }
                            that.timer = setTimeout(function(){ o.source(val, suggest) }, o.delay);
                        }
                    } else {
                        that.last_val = val;
                        that.sc.style.display = 'none';
                        that.sc.classList.add("hide");
                    }
                }
            };
            addEvent(that, 'keyup', that.keyupHandler);

            that.focusHandler = function(e){
                that.last_val = '\n';
                that.keyupHandler(e)
            };
            if (!o.minChars) addEvent(that, 'focus', that.focusHandler);
        }

        // public destroy method
        this.destroy = function(){
            for (var i=0; i<elems.length; i++) {
                var that = elems[i];
                removeEvent(window, 'resize', that.updateSC);
                removeEvent(that, 'blur', that.blurHandler);
                removeEvent(that, 'focus', that.focusHandler);
                removeEvent(that, 'keydown', that.keydownHandler);
                removeEvent(that, 'keyup', that.keyupHandler);
                if (that.autocompleteAttr)
                    that.setAttribute('autocomplete', that.autocompleteAttr);
                else
                    that.removeAttribute('autocomplete');
                document.body.removeChild(that.sc);
                that = null;
            }
        };
    }
    return autoComplete;
})();

(function(){
    if (typeof define === 'function' && define.amd)
        define('autoComplete', function () { return autoComplete; });
    else if (typeof module !== 'undefined' && module.exports)
        module.exports = autoComplete;
    else
        window.autoComplete = autoComplete;
})();
