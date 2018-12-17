import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { PtreadingsComponent } from './ptreadings.component';

describe('PtreadingsComponent', () => {
  let component: PtreadingsComponent;
  let fixture: ComponentFixture<PtreadingsComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ PtreadingsComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(PtreadingsComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
