function Lux_Example_Extension() {
	// module specific override
	this.initModule = function() {
		var ctx = this;
		ctx.log("initModule: extended in " + ctx.constructor.name);
	}	
}