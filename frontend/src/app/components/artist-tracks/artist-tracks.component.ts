import { Component, OnInit } from '@angular/core';

import { ActivatedRoute } from '@angular/router';
import { ArtistdataService } from '../../services/artistdata.service';

@Component({
  selector: 'artist-tracks',
  templateUrl: './artist-tracks.component.html',
  styleUrls: ['./artist-tracks.component.css']
})
export class ArtistTracksComponent implements OnInit {

  artistId: number;
  tracks: any[] = [];

  constructor(private route: ActivatedRoute, private artistData: ArtistdataService) { 
  	let params = this.route.parent.params;
  	params.subscribe(value => this.artistId = value.artistId);
  }

  ngOnInit() {
  	let artistId = this.artistId;
  	this.getTracks(artistId);
  }

  getTracks(artistId) {
  	this.artistData.getTracksByArtistId(artistId).subscribe(response => this.tracks = response.data, 
  		error => console.log(error));
  }

}
