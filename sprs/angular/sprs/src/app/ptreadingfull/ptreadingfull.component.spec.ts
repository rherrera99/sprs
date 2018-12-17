import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { PtreadingfullComponent } from './ptreadingfull.component';

describe('PtreadingfullComponent', () => {
  let component: PtreadingfullComponent;
  let fixture: ComponentFixture<PtreadingfullComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ PtreadingfullComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(PtreadingfullComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
