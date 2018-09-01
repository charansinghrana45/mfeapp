import { Component, OnInit } from '@angular/core';

import { ActivatedRoute } from '@angular/router';
import { ArtistdataService } from '../../services/artistdata.service';



@Component({
  selector: 'app-artist-detail',
  templateUrl: './artist-detail.component.html',
  styleUrls: ['./artist-detail.component.css']
})
export class ArtistDetailComponent implements OnInit {

  artistId: number;
  artistInfo: any;

  constructor(private route: ActivatedRoute, private artistData: ArtistdataService) { 
  	let params = this.route.params;
  	params.subscribe(value => this.artistId = value.artistId);
  }

  ngOnInit() {
  	let artistId = this.artistId;
  	this.getArtistDetail(artistId);
  }

  getArtistDetail(artistId) {
  	this.artistData.getArtistDetail(artistId).subscribe((response) => this.artistInfo = response.data);
  }

}
