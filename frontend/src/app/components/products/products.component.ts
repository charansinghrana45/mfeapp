import { Component, OnInit, Input } from '@angular/core';
import { ArtistdataService } from '../../services/artistdata.service';
import { AuthService } from '../../services/auth.service';
import { FormControl } from '@angular/forms';
import { debounceTime, distinctUntilChanged } from "rxjs/operators";
import { PageChangedEvent } from 'ngx-bootstrap/pagination';

@Component({
  selector: 'app-products',
  templateUrl: './products.component.html',
  styleUrls: ['./products.component.css']
})
export class ProductsComponent implements OnInit {

  artists: object[];
  private searchField: FormControl;
  term: string;
  loading: boolean = false;

  startNumber:number = 0;
  totalCount:number = 0;

  constructor(private artistdata: ArtistdataService, private auth: AuthService) { }

  ngOnInit() {

    this.searchField = new FormControl();
    this.loadArtists(0);
  }

  pageChanged(event: PageChangedEvent): void {
      const startItem = (event.page - 1) * event.itemsPerPage;
      const endItem = event.page * event.itemsPerPage;
      
      this.startNumber = startItem;
      this.loadArtists(startItem);

    }

  loadArtists(startItem) {
      this.loading = true;
      this.artistdata.getArtists(startItem).subscribe(response => this.handleResponse(response), 
                                          (error) => this.handleError(error));
  }

  handleResponse(response) {
  	this.artists = response.data.data;
    this.totalCount = response.data.total_count;
    this.loading = false;
  }

  handleError(error) {
    if(error.status == 401 && error.statusText == 'Unauthorized')
    {
       this.auth.logout();
    }
  }

  doSearch() {

    if(this.term.trim() != '')
    {
      this.loading = true;

      this.artistdata.searchArtist(this.term).subscribe(res => {
        this.loading = false;
        this.artists = res.data
      });
    }
    else
    {
      this.loadArtists(0);
    }

  }

}
