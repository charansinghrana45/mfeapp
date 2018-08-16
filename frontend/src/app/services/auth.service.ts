import { Injectable } from '@angular/core';

import { BehaviorSubject } from 'rxjs';


@Injectable({
  providedIn: 'root'
})
export class AuthService {

  private loggedInStatus: BehaviorSubject<boolean> = new BehaviorSubject<boolean>(false);

  authStatus = this.loggedInStatus.asObservable();
 
  constructor() { }

   changeAuthStaus(value: boolean) {

   	this.loggedInStatus.next(value);
   }


   login(data) {

   	let email = data.email;
   	let password = data.password;

   	if(email == 'admin@gmail.com' && password == 'admin') {
   		return true;
   	} 
   	else {
   		return false;
   	}

   }


}
