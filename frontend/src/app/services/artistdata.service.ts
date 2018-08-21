import { Injectable } from '@angular/core';

import { HttpClient, HttpHeaders } from '@angular/common/http';
import { environment } from '../../environments/environment';
import { Observable } from 'rxjs';
import { TokenService } from './token.service';


@Injectable({
  providedIn: 'root'
})
export class ArtistdataService {

  apiBaseUrl: string;
  httpOptions: object;

  constructor(private http : HttpClient, private token: TokenService) {
  	this.apiBaseUrl = environment.apiBaseUrl;

	let headers = new HttpHeaders();

	this.httpOptions = {
  		 headers: new HttpHeaders().set('Authorization', 'Bearer '+this.token.get())
		};
  }

  getArtists(startItem = 0) : Observable<any> {
 
  	 return this.http.get(this.apiBaseUrl+'/artist/artists/'+startItem+'/10', this.httpOptions);
  }

  getTracksByArtistId(artistId) : Observable<any> {

  	 return this.http.get(this.apiBaseUrl+'/artist/tracks/'+artistId, this.httpOptions);
  }

  getAlbumsByArtistId(artistId) : Observable<any> {
 
  	 return this.http.get(this.apiBaseUrl+'/artist/albums/'+artistId, this.httpOptions);
  }

  getArtistDetail(artistId) : Observable<any> {
  
  	 return this.http.get(this.apiBaseUrl+'/artist/artist_detail/'+artistId, this.httpOptions);
  }

  searchArtist(term) : Observable<any> {
  
     return this.http.get(this.apiBaseUrl+'/artist/search/'+term, this.httpOptions);
  }


}
