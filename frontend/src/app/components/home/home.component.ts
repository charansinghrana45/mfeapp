import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-home',
  templateUrl: './home.component.html',
  styleUrls: ['./home.component.css']
})
export class HomeComponent implements OnInit {

  data: any[] = [];

  constructor() { }

  ngOnInit() {
  	this.data = [
  		{name: 'charan1', email: 'charan.singh1@tradebanya.com', age: '25', city: 'new delhi'},
  		{name: 'charan2', email: 'charan.singh2@tradebanya.com', age: '25', city: 'new delhi'},
  		{name: 'charan3', email: 'charan.singh3@tradebanya.com', age: '25', city: 'new delhi'},
  		{name: 'charan4', email: 'charan.singh4@tradebanya.com', age: '25', city: 'new delhi'},
  		{name: 'charan5', email: 'charan.singh5@tradebanya.com', age: '25', city: 'new delhi'},
  		{name: 'charan6', email: 'charan.singh6@tradebanya.com', age: '25', city: 'new delhi'},
  		{name: 'charan7', email: 'charan.singh7@tradebanya.com', age: '25', city: 'new delhi'},
  		{name: 'charan8', email: 'charan.singh8@tradebanya.com', age: '25', city: 'new delhi'},
  		{name: 'charan9', email: 'charan.singh9@tradebanya.com', age: '25', city: 'new delhi'},
  		{name: 'charan10', email: 'charan.singh10@tradebanya.com', age: '25', city: 'new delhi'},
  		{name: 'charan11', email: 'charan.singh11@tradebanya.com', age: '25', city: 'new delhi'},
  		{name: 'charan12', email: 'charan.singh12@tradebanya.com', age: '25', city: 'new delhi'},
  		{name: 'charan13', email: 'charan.singh13@tradebanya.com', age: '25', city: 'new delhi'},
  		{name: 'charan14', email: 'charan.singh14@tradebanya.com', age: '25', city: 'new delhi'},
  		{name: 'charan15', email: 'charan.singh15@tradebanya.com', age: '25', city: 'new delhi'}
  	];
  }

}
