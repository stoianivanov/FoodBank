/* globals $ */
/* eslint-env node, dirigible */

var entityRegions = require('FoodBank/insert_regions_lib');
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
	var idParameter = entityRegions.getPrimaryKey();
	
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
	
	if(!entityRegions.hasConflictingParameters(id, count, metadata)) {
		// switch based on method type
		if ((method === 'POST')) {
			// create
			entityRegions.createRegions();
		} else if ((method === 'GET')) {
			// read
			if (id) {
				entityRegions.readRegionsEntity(id);
			} else if (count !== null) {
				entityRegions.countRegions();
			} else if (metadata !== null) {
				entityRegions.metadataRegions();
			} else {
				entityRegions.readRegionsList(limit, offset, sort, desc);
			}
		} else if ((method === 'PUT')) {
			// update
			entityRegions.updateRegions();    
		} else if ((method === 'DELETE')) {
			// delete
			if(entityRegions.isInputParameterValid(idParameter)){
				entityRegions.deleteRegions(id);
			}
		} else {
			entityRegions.printError(response.BAD_REQUEST, 4, "Invalid HTTP Method", method);
		}
	}
	
	// flush and close the response
	response.flush();
	response.close();
}