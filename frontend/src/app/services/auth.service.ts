import { Injectable } from '@angular/core';

import { BehaviorSubject } from 'rxjs';
import { HttpClient } from '@angular/common/http';
import { environment } from '../../environments/environment'

import { TokenService } from './token.service';
import { Observable } from 'rxjs';



@Injectable({
  providedIn: 'root'
})
export class AuthService {

  private loggedInStatus: BehaviorSubject<boolean> = new BehaviorSubject<boolean>(this.token.isLoggedIn());

  authStatus = this.loggedInStatus.asObservable();

  private loggedInUserData: BehaviorSubject<string> = new BehaviorSubject<string>(this.token.getUserData());
  authUserData = this.loggedInUserData.asObservable();
 
  constructor(private http: HttpClient, private token: TokenService) { }

   changeAuthStaus(value: boolean) {

   	this.loggedInStatus.next(value);
   }

   changeAuthUserData(value: string) {

     this.loggedInUserData.next(value);
   }


   login(data) {

    let apiBaseUrl = environment.apiBaseUrl;

   	return this.http.post(apiBaseUrl+'/auth/login', data);
   }

}
