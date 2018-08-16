import { Injectable } from '@angular/core';
import { CanActivate, Router, ActivatedRouteSnapshot, RouterStateSnapshot } from '@angular/router';

import { AuthService } from './auth.service';

@Injectable({
  providedIn: 'root'
})
export class AfterLoginService {

  loggedIn: boolean;	

  constructor(private auth: AuthService, private router: Router) {
 
  }

  canActivate(route: ActivatedRouteSnapshot, state: RouterStateSnapshot): boolean {

  	 this.auth.authStatus.subscribe(value => this.loggedIn = value);
  	 
  	 console.log(this.loggedIn);
     if (this.loggedIn) { 
     	
     	return this.loggedIn; 
     }

      // Navigate to the login page with extras
      this.router.navigateByUrl('/login');
   }

}
