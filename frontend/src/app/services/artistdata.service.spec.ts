import { TestBed, inject } from '@angular/core/testing';

import { ArtistdataService } from './artistdata.service';

describe('ArtistdataService', () => {
  beforeEach(() => {
    TestBed.configureTestingModule({
      providers: [ArtistdataService]
    });
  });

  it('should be created', inject([ArtistdataService], (service: ArtistdataService) => {
    expect(service).toBeTruthy();
  }));
});
