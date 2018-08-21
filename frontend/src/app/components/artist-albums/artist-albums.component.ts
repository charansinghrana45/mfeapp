import { Component, OnInit } from '@angular/core';

import { ActivatedRoute } from '@angular/router';
import { ArtistdataService } from '../../services/artistdata.service';

@Component({
  selector: 'artist-albums',
  templateUrl: './artist-albums.component.html',
  styleUrls: ['./artist-albums.component.css']
})
export class ArtistAlbumsComponent implements OnInit {

 artistId: number;
 albums: any[] = [];	

  constructor(private route: ActivatedRoute, private artistData: ArtistdataService) {
  	let params = this.route.parent.params;
  	params.subscribe(value => this.artistId = value.artistId);		
  }

  ngOnInit() {
  	let artistId = this.artistId;
  	this.getAlbums(artistId);
  }

  getAlbums(artistId) {
  	this.artistData.getAlbumsByArtistId(artistId).subscribe(response => this.albums = response.data, 
  		error => console.log(error));
  }

}
