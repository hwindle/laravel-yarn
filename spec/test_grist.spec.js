describe("Test that the grist of the yarn divides the total metres by the ball weight, then times that number by 100",
  function() {

  function yarn_grist(total_meterage, ball_weight) {
    var metres_per_gram = total_meterage / ball_weight;
    var result = Math.round(metres_per_gram * 100);
    return result;
  };

  it("calculates the right value", function() {
    var total_meterage = 90; // total metres here
    var ball_weight = 50; // ball weight

    var correct_result = 180; //correct value to compare function return value to.
    var returned = yarn_grist(total_meterage, ball_weight);
    expect(this.correct_result).toEqual(returned);
  });

});
