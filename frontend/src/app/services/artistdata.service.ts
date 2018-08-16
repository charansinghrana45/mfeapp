import { Injectable } from '@angular/core';

import { HttpClient } from '@angular/common/http';
import { environment } from '../../environments/environment';

@Injectable({
  providedIn: 'root'
})
export class ArtistdataService {

  constructor(private http : HttpClient) { }

  getArtists() {
  	 let apiBaseUrl = environment.apiBaseUrl;

  	 return this.http.get(apiBaseUrl+'/artist/artists');
  }
}
