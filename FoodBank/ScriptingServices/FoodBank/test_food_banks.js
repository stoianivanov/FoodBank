/* globals $ */
/* eslint-env node, dirigible */

var entityFood_banks = require('FoodBank/test_food_banks_lib');
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
	var idParameter = entityFood_banks.getPrimaryKey();
	
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
	
	if(!entityFood_banks.hasConflictingParameters(id, count, metadata)) {
		// switch based on method type
		if ((method === 'POST')) {
			// create
			entityFood_banks.createFood_banks();
		} else if ((method === 'GET')) {
			// read
			if (id) {
				entityFood_banks.readFood_banksEntity(id);
			} else if (count !== null) {
				entityFood_banks.countFood_banks();
			} else if (metadata !== null) {
				entityFood_banks.metadataFood_banks();
			} else {
				entityFood_banks.readFood_banksList(limit, offset, sort, desc);
			}
		} else if ((method === 'PUT')) {
			// update
			entityFood_banks.updateFood_banks();    
		} else if ((method === 'DELETE')) {
			// delete
			if(entityFood_banks.isInputParameterValid(idParameter)){
				entityFood_banks.deleteFood_banks(id);
			}
		} else {
			entityFood_banks.printError(response.BAD_REQUEST, 4, "Invalid HTTP Method", method);
		}
	}
	
	// flush and close the response
	response.flush();
	response.close();
}