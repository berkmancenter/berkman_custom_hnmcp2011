jQuery(function($){
	$.extend( $.ui.tabs.prototype, {
		rotation: null,
		rotationDelay: null,
		continuing: null,
		hnmcp_rotate: function( ms, continuing, cb ) {
			var self = this,
				o = this.options;

			if((ms > 1 || self.rotationDelay === null) && ms !== undefined){//only set rotationDelay if this is the first time through or if not immediately moving on from an unpause
				self.rotationDelay = ms;
			}

			if(continuing !== undefined){
				self.continuing = continuing;
			}

			var rotate = self._rotate || ( self._rotate = function( e ) {
				clearTimeout( self.rotation );
				self.rotation = setTimeout(function() {
					var t = o.active;
					self.option( "active", ++t < self.anchors.length ? t : 0 );

// remove selected class from current tab, add to new one
					var __selected = $('.ui-tabs-selected');

					__selected.removeClass( 'ui-tabs-selected' );
					__selected.next().addClass( 'ui-tabs-selected' );

					var clone = __selected.clone();

					__selected.slideToggle( 'slow', function(){
						$('ul#updateContent').append(clone);
						this.remove();
					} );
				}, ms );

				if ( e ) {
					e.stopPropagation();
				}
			});

			var stop = self._unrotate || ( self._unrotate = !continuing
				? function(e) {
				if (e.clientX) { // in case of a true click
					self.hnmcp_rotate(null);
				}
			}
				: function( e ) {
				t = o.active;
				rotate();
			});

// start rotation
			if ( ms ) {
				this.element.bind( "tabsactivate", rotate );
				this.anchors.bind( o.event + ".tabs", self.pause );
				rotate();
// stop rotation
			} else {
				clearTimeout( self.rotation );
				this.element.unbind( "tabsactivate", rotate );
				this.anchors.unbind( o.event + ".tabs", self.pause );
				delete this._rotate;
				delete this._unrotate;
			}

//rotate immediately and then have normal rotation delay
			if(ms === 1){
//set ms back to what it was originally set to
				ms = self.rotationDelay;
			}

			return this;
		},
		pause: function() {
			var self = this,
				o = this.options;

			self.hnmcp_rotate(0);
		},
		unpause: function(){
			var self = this,
				o = this.options;

			self.hnmcp_rotate(1, self.continuing);
		}
	});
});