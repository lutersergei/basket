(function e(t,n,r){function s(o,u){if(!n[o]){if(!t[o]){var a=typeof require=="function"&&require;if(!u&&a)return a(o,!0);if(i)return i(o,!0);var f=new Error("Cannot find module '"+o+"'");throw f.code="MODULE_NOT_FOUND",f}var l=n[o]={exports:{}};t[o][0].call(l.exports,function(e){var n=t[o][1][e];return s(n?n:e)},l,l.exports,e,t,n,r)}return n[o].exports}var i=typeof require=="function"&&require;for(var o=0;o<r.length;o++)s(r[o]);return s})({1:[function(require,module,exports){
'use strict';

var createNewCatList = function createNewCatList(some) {
	return '<div class="col-sm-6 col-md-4 col-lg-3" id="' + some.id + '"><div class="card card-outline-success text-xs-center"><img class="card-img-top img-fluid" src="images/col-1868614_640.jpg" alt="Card image cap"><span class="lead">' + some.name + '</span></div></div>';
};

var createNewProductsList = function createNewProductsList(some) {
	return '<a class="list-group-item list-group-item-action"><h6 class="list-group-item-heading">' + some.name + '</h6><em>' + some.id + '</em></a>';
};

var $sublist = $('#sublist');
var $productList = $('#productslist');
var $categories = $('#categories');

var subCatList = function subCatList(subListId) {
	$.ajax({
		type: 'GET',
		url: '/jsonfiles/sub' + subListId + '.json',
		dataType: 'json'
	}).done(function (data) {
		$categories.hide(250);
		data.forEach(function (obj) {
			$(createNewCatList(obj)).appendTo($sublist).click(function () {
				productsList($(this).prop('id'));
			});
		});
		$sublist.show(250);
	});
};

var productsList = function productsList(prListId) {
	$.ajax({
		type: 'GET',
		url: '/jsonfiles/list' + prListId + '.json',
		dataType: 'json'
	}).done(function (data) {
		$sublist.hide(250).children().remove();
		data.forEach(function (obj) {
			$(createNewProductsList(obj)).appendTo($productList).click(function () {
				$productList.hide(250).children().remove();
				$categories.show(250);
			});
		});
		$productList.show(250);
	});
};

(function () {
	var len = $categories.find('.card').length;
	for (var i = 0; i < len; i++) {
		$('#10' + i).click(function () {
			subCatList($(this).prop('id'));
		});
	}
})();

},{}]},{},[1]);
