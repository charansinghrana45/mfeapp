import { Injectable } from '@angular/core';
import { CanActivate, Router, ActivatedRouteSnapshot, RouterStateSnapshot } from '@angular/router';

import { AuthService } from './auth.service';

@Injectable({
  providedIn: 'root'
})
export class BeforeLoginService {

  loggedIn: boolean;	

  constructor(private auth: AuthService, private router: Router) {
  	this.auth.authStatus.subscribe(value => this.loggedIn = value);
  }

  canActivate(route: ActivatedRouteSnapshot, state: RouterStateSnapshot): boolean {
  
     return !this.loggedIn;
   }
}
