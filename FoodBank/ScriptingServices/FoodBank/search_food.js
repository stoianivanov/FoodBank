/* globals $ */
/* eslint-env node, dirigible */

var entityProducts = require('FoodBank/search_food_lib');
var request = require("net/http/request");
var response = require("net/http/response");
var xss = require("utils/xss");

handleRequest();

function handleRequest() {
	
	response.setContentType("application/json; charset=UTF-8");
	response.setCharacterEncoding("UTF-8");
	
	// get method type
	var method = request.getMethod();
	method = method.toUpperCase();
	
	//get primary keys (one primary key is supported!)
	var idParameter = entityProducts.getPrimaryKey();
	
	// retrieve the id as parameter if exist 
	var id = xss.escapeSql(request.getAttribute("path"));
	if (!id) {
		id = xss.escapeSql(request.getParameter(idParameter));
	}
	var count = xss.escapeSql(request.getParameter('count'));
	var metadata = xss.escapeSql(request.getParameter('metadata'));
	var sort = xss.escapeSql(request.getParameter('sort'));
	var limit = xss.escapeSql(request.getParameter('limit'));
	var offset = xss.escapeSql(request.getParameter('offset'));
	var desc = xss.escapeSql(request.getParameter('desc'));
	
	if (limit === null) {
		limit = 100;
	}
	if (offset === null) {
		offset = 0;
	}
	
	if(!entityProducts.hasConflictingParameters(id, count, metadata)) {
		// switch based on method type
		if ((method === 'POST')) {
			// create
			entityProducts.createProducts();
		} else if ((method === 'GET')) {
			// read
			if (id) {
				entityProducts.readProductsEntity(id);
			} else if (count !== null) {
				entityProducts.countProducts();
			} else if (metadata !== null) {
				entityProducts.metadataProducts();
			} else {
				entityProducts.readProductsList(limit, offset, sort, desc);
			}
		} else if ((method === 'PUT')) {
			// update
			entityProducts.updateProducts();    
		} else if ((method === 'DELETE')) {
			// delete
			if(entityProducts.isInputParameterValid(idParameter)){
				entityProducts.deleteProducts(id);
			}
		} else {
			entityProducts.printError(response.BAD_REQUEST, 4, "Invalid HTTP Method", method);
		}
	}
	
	// flush and close the response
	response.flush();
	response.close();
}