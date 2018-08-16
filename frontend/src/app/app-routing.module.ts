import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { RouterModule, Routes }  from '@angular/router';
import { BeforeLoginService } from './services/before-login.service';
import { AfterLoginService } from './services/after-login.service';

import { LoginComponent } from './components/login/login.component';
import { SignupComponent } from './components/signup/signup.component';
import { ProductsComponent } from './components/products/products.component';
import { PageNotFoundComponent } from './components/page-not-found/page-not-found.component';
import { ServicesComponent } from './components/services/services.component';
import { AboutUsComponent } from './components/about-us/about-us.component';
import { HomeComponent } from './components/home/home.component';
import { ProfileComponent } from './components/profile/profile.component';
import { SettingsComponent } from './components/settings/settings.component';
import { ArtistDetailComponent } from './components/artist-detail/artist-detail.component';
import { ArtistTracksComponent } from './components/artist-tracks/artist-tracks.component';
import { ArtistAlbumsComponent } from './components/artist-albums/artist-albums.component';

const appRoutes: Routes = [
  { path: '', redirectTo: 'home', pathMatch: 'full' },
  { path: 'home', component: HomeComponent, canActivate: [AfterLoginService] },
  { path: 'login', component: LoginComponent, canActivate: [BeforeLoginService] },
  { path: 'signup', component: SignupComponent, canActivate: [BeforeLoginService] },
  { path: 'artists', component: ProductsComponent, canActivate: [AfterLoginService] },
  { path: 'artists/:artistId', component: ArtistDetailComponent,
    children: [
      { path: '', redirectTo: 'tracks', pathMatch: 'full' },
      { path: 'tracks', component: ArtistTracksComponent },
      { path: 'albums', component: ArtistAlbumsComponent },
    ]
  },
  { path: 'services', component: ServicesComponent, canActivate: [AfterLoginService] },
  { path: 'about-us', component: AboutUsComponent, canActivate: [] },
  { path: 'profile', component: ProfileComponent, canActivate: [AfterLoginService] },
  { path: 'settings', component: SettingsComponent, canActivate: [AfterLoginService] },
  { path: '**', component: PageNotFoundComponent }
];

@NgModule({
  imports: [
    CommonModule,
    RouterModule.forRoot(appRoutes),
  ],
  declarations: [],
  exports: [
    RouterModule
  ]
})
export class AppRoutingModule { }
