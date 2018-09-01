import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { AppRoutingModule } from './app-routing.module';
import { HttpClientModule } from '@angular/common/http';
import { BsDropdownModule } from 'ngx-bootstrap';
import { PaginationModule } from 'ngx-bootstrap';

import { AuthService } from './services/auth.service';
import { BeforeLoginService } from './services/before-login.service';
import { AfterLoginService } from './services/after-login.service';
import { TokenService } from './services/token.service';
import { ArtistdataService } from './services/artistdata.service';

import { AppComponent } from './app.component';
import { HeaderComponent } from './components/header/header.component';
import { NavBarComponent } from './components/nav-bar/nav-bar.component';
import { FooterComponent } from './components/footer/footer.component';
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

@NgModule({
  declarations: [
    AppComponent,
    HeaderComponent,
    NavBarComponent,
    FooterComponent,
    LoginComponent,
    SignupComponent,
    ProductsComponent,
    PageNotFoundComponent,
    ServicesComponent,
    AboutUsComponent,
    HomeComponent,
    ProfileComponent,
    SettingsComponent,
    ArtistDetailComponent,
    ArtistTracksComponent,
    ArtistAlbumsComponent,
  ],
  imports: [
    BrowserModule,
    BsDropdownModule.forRoot(),
    AppRoutingModule,
    FormsModule,
    HttpClientModule,
    ReactiveFormsModule,
    PaginationModule.forRoot(),
  ],
  providers: [AuthService, TokenService, BeforeLoginService, AfterLoginService, ArtistdataService],
  bootstrap: [AppComponent]
})
export class AppModule { }
