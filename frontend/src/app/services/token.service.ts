import { Injectable } from '@angular/core';
import { environment } from '../../environments/environment'

@Injectable({
  providedIn: 'root'
})
export class TokenService {

   private iss = {
  	login: environment.apiBaseUrl+'/auth/login',
  	signup: environment.apiBaseUrl+'/auth/signup'
  };	

  constructor() { }

  handleToken(token) {
	this.set(token);
  }

  set(token) {
  	localStorage.setItem('token', token);
  }

  get() {
  	return localStorage.getItem('token');
  }

  remove() {
  	localStorage.removeItem('token');
  }

  isValid() {

  	const token = this.get();

  	if(token)
  	{
  		const payload = this.getPayload(token);

  		if(payload) {

  			return (Object.values(this.iss).indexOf(payload.iss) > -1 ) ? true : false;
  		}
  	}

  	return false;
  }

  getPayload(token) {
  	
  	const payload = token.split('.')[1];

  	return JSON.parse(atob(payload));
  }

  isLoggedIn() {

  	 return this.isValid();
  }

  handleUserData(data) {
    const name = data.firstName +' '+ data.lastName;
    localStorage.setItem('name', name);
  }

  getUserData() {

    if(localStorage.getItem('name')) {
      return localStorage.getItem('name');
    }
    else {
      return '';
    }
  }

  removeUserData() {
    localStorage.removeItem('name');
  }

}
