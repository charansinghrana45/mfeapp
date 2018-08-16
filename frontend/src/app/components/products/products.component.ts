import { Component, OnInit, Input } from '@angular/core';
import { ArtistdataService } from '../../services/artistdata.service';

@Component({
  selector: 'app-products',
  templateUrl: './products.component.html',
  styleUrls: ['./products.component.css']
})
export class ProductsComponent implements OnInit {

  artists : object[];
  constructor(private artistdata: ArtistdataService) { }

  ngOnInit() {

  	this.artistdata.getArtists().subscribe(response => this.handleResponse(response), 
                                        (error) => this.handleError(error));
  }

  handleResponse(response) {
  	this.artists = response.data;
  }

  handleError(error) {
    console.log(error.error.error);
  }

}
