/* globals $ */
/* eslint-env node, dirigible */

var entityFood_types = require('FoodBank/getFoodTypes_lib');
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
	var idParameter = entityFood_types.getPrimaryKey();
	
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
	
	if(!entityFood_types.hasConflictingParameters(id, count, metadata)) {
		// switch based on method type
		if ((method === 'POST')) {
			// create
			entityFood_types.createFood_types();
		} else if ((method === 'GET')) {
			// read
			if (id) {
				entityFood_types.readFood_typesEntity(id);
			} else if (count !== null) {
				entityFood_types.countFood_types();
			} else if (metadata !== null) {
				entityFood_types.metadataFood_types();
			} else {
				entityFood_types.readFood_typesList(limit, offset, sort, desc);
			}
		} else if ((method === 'PUT')) {
			// update
			entityFood_types.updateFood_types();    
		} else if ((method === 'DELETE')) {
			// delete
			if(entityFood_types.isInputParameterValid(idParameter)){
				entityFood_types.deleteFood_types(id);
			}
		} else {
			entityFood_types.printError(response.BAD_REQUEST, 4, "Invalid HTTP Method", method);
		}
	}
	
	// flush and close the response
	response.flush();
	response.close();
}