import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { DrforgotnewComponent } from './drforgotnew.component';

describe('DrforgotnewComponent', () => {
  let component: DrforgotnewComponent;
  let fixture: ComponentFixture<DrforgotnewComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ DrforgotnewComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(DrforgotnewComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
